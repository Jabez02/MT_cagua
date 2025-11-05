<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Booking;
use App\Services\PaymentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\Notifications\PaymentVerified;
use App\Notifications\PaymentUnderReview;
use App\Notifications\PaymentRejected;

class PaymentController extends Controller
{
    protected $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    /**
     * Display a listing of payments.
     */
    public function index(Request $request)
    {
        $query = Payment::with(['booking.user', 'paymentMethod'])
            ->orderBy('created_at', 'desc');

        // Apply search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('id', 'like', "%{$search}%")
                  ->orWhere('transaction_id', 'like', "%{$search}%")
                  ->orWhereHas('booking', function ($bookingQuery) use ($search) {
                      $bookingQuery->where('id', 'like', "%{$search}%")
                                   ->orWhere('trail', 'like', "%{$search}%");
                  })
                  ->orWhereHas('booking.user', function ($userQuery) use ($search) {
                      $userQuery->where('name', 'like', "%{$search}%")
                                ->orWhere('email', 'like', "%{$search}%");
                  });
            });
        }

        // Apply status filter with improved logic
        if ($request->filled('status')) {
            switch ($request->status) {
                case 'pending':
                    $query->whereNull('verified_at')
                          ->whereNull('rejected_at')
                          ->where('refunded', false);
                    break;
                case 'completed':
                    $query->whereNotNull('verified_at')
                          ->whereNull('rejected_at')
                          ->where('refunded', false);
                    break;
                case 'rejected':
                    $query->whereNotNull('rejected_at')
                          ->where('refunded', false);
                    break;
                case 'refunded':
                    $query->where('refunded', true);
                    break;
                case 'under_review':
                    $query->whereNotNull('payment_data->flagged_at')
                          ->whereNull('verified_at')
                          ->whereNull('rejected_at')
                          ->where('refunded', false);
                    break;
            }
        }

        // Apply date range filter
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        // Apply payment method filter (fix to use payment_method field)
        if ($request->filled('payment_method')) {
            $query->where('payment_method', $request->payment_method);
        }

        // Apply amount range filter
        if ($request->filled('min_amount')) {
            $query->where('amount', '>=', $request->min_amount);
        }
        if ($request->filled('max_amount')) {
            $query->where('amount', '<=', $request->max_amount);
        }

        $payments = $query->paginate(10)
            ->appends($request->query());

        // Calculate statistics for the dashboard
        $totalRevenue = Payment::whereNotNull('verified_at')
            ->where('refunded', false)
            ->sum('amount');

        $successfulPayments = Payment::whereNotNull('verified_at')
            ->where('refunded', false)
            ->count();

        $pendingPayments = Payment::whereNull('verified_at')
            ->whereNull('refunded_at')
            ->count();

        $failedPayments = Payment::where('refunded', true)
            ->count();

        // Get payment methods for the filter dropdown
        $paymentMethods = \App\Models\PaymentMethod::active()
            ->orderBy('name')
            ->get();

        return view('admin.payments.index', compact(
            'payments', 
            'totalRevenue', 
            'successfulPayments', 
            'pendingPayments', 
            'failedPayments',
            'paymentMethods'
        ));
    }

    /**
     * Show payment details for verification.
     */
    public function show(Payment $payment)
    {
        $payment->load(['booking.user']);
        
        // Generate audit trail data for inline display
        $auditTrail = [
            'payment_created' => [
                'timestamp' => $payment->created_at,
                'action' => 'Payment Submitted',
                'details' => "Payment of ₱{$payment->amount} submitted via {$payment->payment_method}",
            ],
        ];

        if ($payment->verified_at) {
            $verifiedBy = $payment->payment_data['verified_by'] ?? 'Unknown';
            $auditTrail['payment_verified'] = [
                'timestamp' => $payment->verified_at,
                'action' => 'Payment Verified',
                'details' => "Verified by Admin ID: {$verifiedBy}",
            ];
        }

        if (isset($payment->payment_data['flagged_at'])) {
            $reviewReason = $payment->payment_data['review_reason'] ?? 'No reason provided';
            $auditTrail['payment_flagged'] = [
                'timestamp' => \Carbon\Carbon::parse($payment->payment_data['flagged_at']),
                'action' => 'Flagged for Review',
                'details' => "Reason: {$reviewReason}",
            ];
        }

        if ($payment->refunded) {
            $refundId = $payment->refund_id ?? 'N/A';
            $auditTrail['payment_refunded'] = [
                'timestamp' => $payment->refunded_at,
                'action' => 'Payment Refunded',
                'details' => "Refund ID: {$refundId}",
            ];
        }

        // Sort audit trail by timestamp
        uasort($auditTrail, function ($a, $b) {
            return $b['timestamp'] <=> $a['timestamp'];
        });
        
        return view('admin.payments.show', compact('payment', 'auditTrail'));
    }

    /**
     * Verify a payment.
     */
    public function verify(Request $request, Payment $payment)
    {
        try {
            // Validate request
            $validated = $request->validate([
                'admin_notes' => ['nullable', 'string', 'max:1000'],
            ]);

            // Update payment record
            $payment->update([
                'verified_at' => now(),
                'verified_by' => auth()->id(),
                'payment_data' => array_merge($payment->payment_data ?? [], [
                    'admin_notes' => $validated['admin_notes'] ?? null,
                    'verification_date' => now()->toDateTimeString(),
                ]),
            ]);

            // Update booking status if booking exists
            if ($payment->booking) {
                $payment->booking->update([
                    'status' => 'confirmed'
                ]);
            }

            // Log the verification
            Log::info('Payment verified', [
                'payment_id' => $payment->id,
                'booking_id' => $payment->booking_id,
                'verified_by' => auth()->id(),
                'amount' => $payment->amount,
            ]);

            // Send notification to user if booking and user exist
            if ($payment->booking && $payment->booking->user) {
                $payment->booking->user->notify(new PaymentVerified($payment));
            }

            return redirect()
                ->route('admin.payments.show', $payment)
                ->with('success', 'Payment verified successfully.');

        } catch (\Exception $e) {
            Log::error('Payment verification failed', [
                'payment_id' => $payment->id,
                'error' => $e->getMessage(),
            ]);

            return back()
                ->withInput()
                ->with('error', 'Failed to verify payment. Please try again.');
        }
    }

    /**
     * Reject a payment.
     */
    public function reject(Request $request, Payment $payment)
    {
        $validated = $request->validate([
            'rejection_reason' => ['required', 'string', 'max:1000'],
        ]);

        try {
            $payment->update([
                'status' => 'rejected',
                'rejected_at' => now(),
                'rejected_by' => auth()->id(),
                'payment_data' => array_merge($payment->payment_data ?? [], [
                    'rejection_reason' => $validated['rejection_reason'],
                ]),
            ]);

            // Update booking status to rejected if booking exists
            if ($payment->booking) {
                $payment->booking->update([
                    'status' => 'rejected'
                ]);
            }

            // Log the rejection
            Log::info('Payment rejected', [
                'payment_id' => $payment->id,
                'booking_id' => $payment->booking_id,
                'rejected_by' => auth()->id(),
                'reason' => $validated['rejection_reason'],
            ]);

            // Notify user about the rejection if booking and user exist
            if ($payment->booking && $payment->booking->user) {
                $payment->booking->user->notify(new PaymentRejected($payment));
            }

            return redirect()
                ->route('admin.payments.show', $payment)
                ->with('success', 'Payment has been rejected.');

        } catch (\Exception $e) {
            Log::error('Payment rejection failed', [
                'payment_id' => $payment->id,
                'error' => $e->getMessage(),
            ]);

            return back()
                ->withInput()
                ->with('error', 'Failed to reject payment. Please try again.');
        }
    }

    /**
     * Flag a payment for review.
     */
    public function flag(Request $request, Payment $payment)
    {
        $validated = $request->validate([
            'issue_description' => ['required', 'string', 'max:1000'],
        ]);

        $payment->update([
            'status' => 'review_required',
            'payment_data' => array_merge($payment->payment_data ?? [], [
                'review_reason' => $validated['issue_description'],
                'flagged_by' => auth()->id(),
                'flagged_at' => now()->toDateTimeString(),
            ]),
        ]);

        // Log the review flag
        Log::info('Payment flagged for review', [
            'payment_id' => $payment->id,
            'booking_id' => $payment->booking_id,
            'flagged_by' => auth()->id(),
            'reason' => $validated['issue_description'],
        ]);

        // Notify user about the review
        $payment->booking->user->notify(new PaymentUnderReview($payment));

        return redirect()
            ->route('admin.payments.show', $payment)
            ->with('success', 'Payment has been flagged for review.');
    }

    /**
     * Get payment audit trail.
     */
    public function auditTrail(Payment $payment)
    {
        $payment->load(['booking.user']);
        
        $auditTrail = [
            'payment_created' => [
                'timestamp' => $payment->created_at,
                'action' => 'Payment Submitted',
                'details' => "Payment of ₱{$payment->amount} submitted via {$payment->payment_method}",
            ],
        ];

        if ($payment->verified_at) {
            $auditTrail['payment_verified'] = [
                'timestamp' => $payment->verified_at,
                'action' => 'Payment Verified',
                'details' => "Verified by Admin ID: {$payment->payment_data['verified_by']}",
            ];
        }

        if (isset($payment->payment_data['flagged_at'])) {
            $auditTrail['payment_flagged'] = [
                'timestamp' => Carbon::parse($payment->payment_data['flagged_at']),
                'action' => 'Flagged for Review',
                'details' => "Reason: {$payment->payment_data['review_reason']}",
            ];
        }

        if ($payment->refunded) {
            $auditTrail['payment_refunded'] = [
                'timestamp' => $payment->refunded_at,
                'action' => 'Payment Refunded',
                'details' => "Refund ID: {$payment->refund_id}",
            ];
        }

        // Sort audit trail by timestamp
        uasort($auditTrail, function ($a, $b) {
            return $b['timestamp'] <=> $a['timestamp'];
        });

        return view('admin.payments.audit-trail', compact('payment', 'auditTrail'));
    }

    /**
     * Export payments to CSV.
     */
    public function export()
    {
        if (auth()->user()->usertype !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $payments = Payment::with(['booking.user'])
            ->orderBy('created_at', 'desc')
            ->get();

        $csvData = [];
        $csvData[] = [
            'Payment ID',
            'Booking',
            'User',
            'Amount',
            'Method',
            'Status',
            'Date'
        ];

        foreach ($payments as $payment) {
            // Determine payment status
            $status = 'Pending';
            if ($payment->refunded) {
                $status = 'Refunded';
            } elseif ($payment->rejected_at) {
                $status = 'Rejected';
            } elseif ($payment->verified_at) {
                $status = 'Completed';
            }

            $csvData[] = [
                $payment->id,
                $payment->booking ? '#' . $payment->booking->id : 'No Booking',
                $payment->booking && $payment->booking->user ? $payment->booking->user->name : 'Unknown User',
                'PHP ' . number_format($payment->amount, 2),
                $payment->paymentMethod ? $payment->paymentMethod->name : ucfirst(str_replace('_', ' ', $payment->payment_method)),
                $status,
                $payment->created_at->format('Y-m-d H:i:s')
            ];
        }

        $filename = 'payments_export_' . date('Y-m-d_H-i-s') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($csvData) {
            $file = fopen('php://output', 'w');
            // Add UTF-8 BOM for Excel compatibility
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            foreach ($csvData as $row) {
                fputcsv($file, $row);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}