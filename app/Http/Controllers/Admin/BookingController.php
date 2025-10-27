<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Guide;
use App\Models\Porter;
use App\Models\User;
use App\Notifications\CustomBookingApproved;
use App\Notifications\CustomBookingRejected;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        if (auth()->user()->usertype !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $query = Booking::with(['user', 'hike', 'guide', 'porter', 'approver']);

        // Apply search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('id', 'like', "%{$search}%")
                  ->orWhereHas('user', function($userQuery) use ($search) {
                      $userQuery->where('name', 'like', "%{$search}%")
                               ->orWhere('email', 'like', "%{$search}%");
                  })
                  ->orWhereHas('hike', function($hikeQuery) use ($search) {
                      $hikeQuery->where('name', 'like', "%{$search}%");
                  })
                  ->orWhere('trail', 'like', "%{$search}%");
            });
        }

        // Apply status filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Apply booking type filter
        if ($request->filled('booking_type')) {
            if ($request->booking_type === 'custom') {
                $query->whereNull('hike_id');
            } elseif ($request->booking_type === 'regular') {
                $query->whereNotNull('hike_id');
            }
        }

        // Apply date range filter
        if ($request->filled('date_range')) {
            $now = Carbon::now();
            switch ($request->date_range) {
                case 'today':
                    $query->whereDate('created_at', $now->toDateString());
                    break;
                case 'this_week':
                    $query->whereBetween('created_at', [$now->startOfWeek(), $now->endOfWeek()]);
                    break;
                case 'this_month':
                    $query->whereMonth('created_at', $now->month)
                          ->whereYear('created_at', $now->year);
                    break;
                case 'custom':
                    if ($request->filled('start_date') && $request->filled('end_date')) {
                        $query->whereBetween('created_at', [
                            Carbon::parse($request->start_date)->startOfDay(),
                            Carbon::parse($request->end_date)->endOfDay()
                        ]);
                    }
                    break;
            }
        }

        $bookings = $query->orderBy('created_at', 'desc')
                         ->paginate(10)
                         ->appends($request->query());
        
        return view('admin.bookings.index', compact('bookings'));
    }

    public function export()
    {
        if (auth()->user()->usertype !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $bookings = Booking::with(['user', 'hike', 'guide', 'porter', 'approver'])
                        ->orderBy('created_at', 'desc')
                        ->get();

        $csvData = [];
        $csvData[] = [
            'ID',
            'User Name',
            'User Email',
            'Hike Name',
            'Foreign Tourists',
            'Local Tourists',
            'Length of Stay',
            'Transportation',
            'Tourist Fee',
            'Guide Fee',
            'Porter Fee',
            'Total Amount',
            'Down Payment',
            'Payment Method',
            'Payment Reference',
            'Meeting Place',
            'Status',
            'Guide',
            'Porter',
            'Approved At',
            'Approved By',
            'Created At',
            'Special Requests',
            'Cancellation Reason'
        ];

        foreach ($bookings as $booking) {
            $csvData[] = [
                $booking->id,
                $booking->user->name ?? 'N/A',
                $booking->user->email ?? 'N/A',
                $booking->hike->name ?? 'N/A',
                $booking->foreign_tourists,
                $booking->local_tourists,
                ucfirst(str_replace('_', ' ', $booking->length_of_stay)),
                ucfirst(str_replace('_', ' ', $booking->transportation)),
                number_format($booking->tourist_fee, 2),
                number_format($booking->guide_fee, 2),
                number_format($booking->porter_fee, 2),
                number_format($booking->total_amount, 2),
                number_format($booking->down_payment, 2),
                ucfirst(str_replace('_', ' ', $booking->payment_method)),
                $booking->payment_reference ?? 'N/A',
                ucfirst(str_replace('_', ' ', $booking->meeting_place)),
                ucfirst($booking->status),
                $booking->guide->name ?? 'Not Assigned',
                $booking->porter->name ?? 'Not Assigned',
                $booking->approved_at ? $booking->approved_at->format('Y-m-d H:i:s') : 'N/A',
                $booking->approver->name ?? 'N/A',
                $booking->created_at->format('Y-m-d H:i:s'),
                $booking->special_requests ?? 'N/A',
                $booking->cancellation_reason ?? 'N/A'
            ];
        }

        $filename = 'bookings_export_' . date('Y-m-d_H-i-s') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($csvData) {
            $file = fopen('php://output', 'w');
            foreach ($csvData as $row) {
                fputcsv($file, $row);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function approve(Booking $booking)
    {
        if (auth()->user()->usertype !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        // Handle custom bookings (no hike_id) differently
        if ($booking->hike_id === null) {
            // For custom bookings, approve and set to payment_pending
            $booking->update([
                'status' => 'payment_pending',
                'approved_at' => Carbon::now(),
                'approved_by' => Auth::id()
            ]);

            // Send notification to the user
            $booking->user->notify(new CustomBookingApproved($booking));

            return back()->with('success', 'Custom booking approved successfully. Customer can now proceed with payment.');
        }

        // For regular bookings, check if booking has payment proof submitted
        $payment = $booking->payments()->first();
        
        if (!$payment || $payment->status !== 'pending') {
            return back()->with('error', 'Cannot approve booking without verified payment proof.');
        }

        // Verify payment and approve booking in one action
        $payment->update([
            'status' => 'completed',
            'verified_at' => now(),
            'verified_by' => auth()->id(),
            'payment_data' => array_merge($payment->payment_data ?? [], [
                'verification_date' => now()->toDateTimeString(),
                'verified_by' => auth()->id(),
            ]),
        ]);

        $booking->update([
            'status' => 'confirmed',
            'approved_at' => Carbon::now(),
            'approved_by' => Auth::id()
        ]);

        return back()->with('success', 'Payment verified and booking approved successfully.');
    }

    public function reject(Booking $booking)
    {
        if (auth()->user()->usertype !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $booking->update([
            'status' => 'rejected',
            'approved_at' => null,
            'approved_by' => Auth::id()
        ]);

        // For custom bookings, provide specific feedback and send notification
        if ($booking->hike_id === null) {
            // Send notification to the user
            $booking->user->notify(new CustomBookingRejected($booking, 'Your custom booking request did not meet our requirements.'));
            
            return back()->with('success', 'Custom booking has been rejected successfully.');
        }

        return back()->with('success', 'Booking has been rejected successfully.');
    }

    public function show(Booking $booking)
    {
        if (auth()->user()->usertype !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $booking->load(['user', 'approver', 'guide', 'porter']);
        return view('admin.bookings.show', compact('booking'));
    }

    public function edit(Booking $booking)
    {
        if (auth()->user()->usertype !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $guides = Guide::where('status', 'active')->get();
        $porters = Porter::where('status', 'active')->get();
        $booking->load(['user', 'guide', 'porter']);

        return view('admin.bookings.edit', compact('booking', 'guides', 'porters'));
    }

    public function update(Request $request, Booking $booking)
    {
        if (auth()->user()->usertype !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        // Only allow guide and porter assignment changes
        $validated = $request->validate([
            'guide_id' => ['nullable', 'exists:guides,id'],
            'porter_id' => ['nullable', 'exists:porters,id'],
        ]);

        // Calculate guide fee
        $guideFee = 0;
        if ($validated['guide_id']) {
            $guide = Guide::find($validated['guide_id']);
            if ($guide) {
                $guideFee = $guide->rate_per_day * $booking->length_of_stay;
            }
        }

        // Calculate porter fee
        $porterFee = 0;
        if ($validated['porter_id']) {
            $porter = Porter::find($validated['porter_id']);
            if ($porter) {
                $porterFee = $porter->rate_per_day * $booking->length_of_stay;
            }
        }

        // Calculate new total amount
        $baseAmount = $booking->total_amount - $booking->guide_fee - $booking->porter_fee;
        $newTotalAmount = $baseAmount + $guideFee + $porterFee;

        // Update booking with staff assignments and fees
        $booking->update([
            'guide_id' => $validated['guide_id'],
            'porter_id' => $validated['porter_id'],
            'guide_fee' => $guideFee,
            'porter_fee' => $porterFee,
            'total_amount' => $newTotalAmount,
        ]);

        return redirect()
            ->route('admin.bookings.show', $booking)
            ->with('success', 'Staff assignment and fees updated successfully.');
    }

    public function cancel(Request $request, Booking $booking)
    {
        if (auth()->user()->usertype !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'reason' => ['required', 'string', 'max:500'],
            'other_reason' => ['nullable', 'string', 'max:1000'],
            'refund_required' => ['boolean'],
            'admin_notes' => ['nullable', 'string', 'max:1000'],
        ]);

        try {
            // Combine reason with other_reason if provided
            $cancellationReason = $validated['reason'];
            if ($validated['reason'] === 'Other' && !empty($validated['other_reason'])) {
                $cancellationReason = $validated['other_reason'];
            }

            // Check if booking has verified payment and refund is requested
            if (isset($validated['refund_required']) && $validated['refund_required'] && 
                $booking->payment && $booking->payment->verified_at && !$booking->payment->refunded) {
                
                $paymentService = new \App\Services\PaymentService();
                $refunded = $paymentService->processRefund($booking->payment);

                if (!$refunded) {
                    return back()->with('error', 'Failed to process refund. Please try again or contact technical support.');
                }

                $booking->update([
                    'status' => 'cancelled',
                    'cancellation_reason' => $cancellationReason,
                    'approved_at' => null,
                    'approved_by' => null
                ]);

                // Decrease the hike's current bookings count (only for regular bookings)
                if ($booking->hike) {
                    $booking->hike->decrement('current_bookings', 
                        $booking->foreign_tourists + $booking->local_tourists);
                }

                return back()->with('success', 'Booking cancelled and refund processed successfully. Customer will receive refund within 3-5 business days.');
            }

            // Regular cancellation without refund
            $booking->update([
                'status' => 'cancelled',
                'cancellation_reason' => $cancellationReason,
                'approved_at' => null,
                'approved_by' => null
            ]);

            // Decrease the hike's current bookings count (only for regular bookings)
            if ($booking->hike) {
                $booking->hike->decrement('current_bookings', 
                    $booking->foreign_tourists + $booking->local_tourists);
            }

            return back()->with('success', 'Booking has been cancelled successfully.');
            
        } catch (\Exception $e) {
            \Log::error('Admin booking cancellation failed: ' . $e->getMessage(), [
                'booking_id' => $booking->id,
                'admin_id' => auth()->id(),
                'refund_requested' => $validated['refund_required'] ?? false
            ]);
            
            return back()->with('error', 'Failed to cancel booking. Please try again or contact technical support.');
        }
    }

    public function verifyPayment(Request $request, Booking $booking)
    {
        try {
            // Validate request
            $validated = $request->validate([
                'verification_notes' => 'nullable|string|max:1000'
            ]);

            // Check if booking is in payment verification pending status
            if ($booking->status !== 'payment_verification_pending') {
                return back()->with('error', 'This booking is not pending payment verification.');
            }

            // Get the payment record
            $payment = $booking->payment;
            if (!$payment) {
                return back()->with('error', 'No payment record found for this booking.');
            }

            // Perform validation checks
            $validationErrors = [];

            // 1. Check payment amount matches down payment amount
            if ($payment->amount < $booking->down_payment) {
                $validationErrors[] = "Payment amount (₱{$payment->amount}) is less than required down payment (₱{$booking->down_payment})";
            }

            // 2. Check payment method is valid
            $validPaymentMethods = ['bank_transfer', 'gcash', 'paymaya', 'cash'];
            if (!in_array($payment->payment_method, $validPaymentMethods)) {
                $validationErrors[] = "Invalid payment method: {$payment->payment_method}";
            }

            // 3. Check payment timestamp is within acceptable range (e.g., within 7 days of booking)
            $paymentDate = Carbon::parse($payment->created_at);
            $bookingDate = Carbon::parse($booking->created_at);
            $daysDifference = $paymentDate->diffInDays($bookingDate);
            
            if ($daysDifference > 7) {
                $validationErrors[] = "Payment was submitted {$daysDifference} days after booking creation (maximum 7 days allowed)";
            }

            // 4. Check payment reference is provided
            if (empty($payment->transaction_id)) {
                $validationErrors[] = "Payment transaction ID is missing";
            }

            // If there are validation errors, reject the payment
            if (!empty($validationErrors)) {
                return $this->rejectPayment($request, $booking, implode('; ', $validationErrors));
            }

            // All validations passed - approve the payment
            $booking->update([
                'status' => 'confirmed',
                'payment_verified_at' => now(),
                'payment_verified_by' => auth()->id(),
                'verification_notes' => $validated['verification_notes']
            ]);

            // Update payment status
            $payment->update([
                'status' => 'verified',
                'verified_at' => now(),
                'verified_by' => auth()->id()
            ]);

            // Log the verification action
            \Log::info('Payment verified successfully', [
                'booking_id' => $booking->id,
                'payment_id' => $payment->id,
                'verified_by' => auth()->id(),
                'verification_notes' => $validated['verification_notes']
            ]);

            // TODO: Send notification to customer about payment verification success

            return back()->with('success', 'Payment has been verified successfully. Booking is now confirmed.');

        } catch (\Exception $e) {
            \Log::error('Payment verification failed: ' . $e->getMessage(), [
                'booking_id' => $booking->id,
                'admin_id' => auth()->id()
            ]);
            
            return back()->with('error', 'Failed to verify payment. Please try again.');
        }
    }

    public function rejectPayment(Request $request, Booking $booking, $autoRejectionReason = null)
    {
        try {
            // Validate request if not auto-rejection
            if (!$autoRejectionReason) {
                $validated = $request->validate([
                    'rejection_reason' => 'required|string|in:incorrect_amount,invalid_method,expired_payment,invalid_reference,other',
                    'rejection_notes' => 'nullable|string|max:1000',
                    'other_reason' => 'required_if:rejection_reason,other|string|max:500'
                ]);

                $rejectionReason = $validated['rejection_reason'];
                if ($rejectionReason === 'other') {
                    $rejectionReason = $validated['other_reason'];
                }
                $rejectionNotes = $validated['rejection_notes'] ?? '';
            } else {
                $rejectionReason = $autoRejectionReason;
                $rejectionNotes = 'Automatic rejection due to validation failures';
            }

            // Check if booking is in payment verification pending status
            if ($booking->status !== 'payment_verification_pending') {
                return back()->with('error', 'This booking is not pending payment verification.');
            }

            // Update booking status
            $booking->update([
                'status' => 'payment_rejected',
                'payment_rejected_at' => now(),
                'payment_rejected_by' => auth()->id(),
                'rejection_reason' => $rejectionReason,
                'rejection_notes' => $rejectionNotes
            ]);

            // Update payment status if exists
            if ($booking->payment) {
                $booking->payment->update([
                    'status' => 'rejected',
                    'rejected_at' => now(),
                    'rejected_by' => auth()->id()
                ]);
            }

            // Log the rejection action
            \Log::info('Payment rejected', [
                'booking_id' => $booking->id,
                'rejected_by' => auth()->id(),
                'rejection_reason' => $rejectionReason,
                'rejection_notes' => $rejectionNotes
            ]);

            // TODO: Send notification to customer about payment rejection

            return back()->with('success', 'Payment has been rejected. Customer will be notified to resubmit payment.');

        } catch (\Exception $e) {
            \Log::error('Payment rejection failed: ' . $e->getMessage(), [
                'booking_id' => $booking->id,
                'admin_id' => auth()->id()
            ]);
            
            return back()->with('error', 'Failed to reject payment. Please try again.');
        }
    }
}
