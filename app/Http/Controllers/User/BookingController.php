<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Hike;
use App\Models\Payment;
use App\Models\PaymentMethod;
use App\Services\PaymentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $query = Booking::with(['hike', 'guide', 'porter', 'payments'])
            ->where('user_id', auth()->id());

        if ($request->has('payment_status')) {
            switch ($request->payment_status) {
                case 'pending':
                    $query->whereHas('payments', function ($q) {
                        $q->whereNull('verified_at')
                          ->whereNull('refunded_at');
                    });
                    break;
                case 'verified':
                    $query->whereHas('payments', function ($q) {
                        $q->whereNotNull('verified_at')
                          ->whereNull('refunded_at');
                    });
                    break;
                case 'refunded':
                    $query->whereHas('payments', function ($q) {
                        $q->whereNotNull('refunded_at');
                    });
                    break;
            }
        }

        $bookings = $query->orderBy('created_at', 'desc')
            ->paginate(10)
            ->appends($request->query());

        $paymentStatusOptions = [
            'all' => 'All Payments',
            'pending' => 'Payment Pending',
            'verified' => 'Payment Verified',
            'refunded' => 'Payment Refunded'
        ];

        return view('user.bookings.index', compact('bookings', 'paymentStatusOptions'));
    }

    public function create(Hike $hike = null)
    {
        $paymentMethods = PaymentMethod::active()->byPriority()->get();
        
        return view('user.bookings.create', compact('paymentMethods', 'hike'));
    }

    public function store(Request $request)
    {
        $paymentMethods = PaymentMethod::active()->pluck('code')->toArray();
        
        // Determine booking type first
        $bookingType = $request->input('booking_type', 'existing');
        $isCustomBooking = $bookingType === 'custom';
        
        $validated = $request->validate([
            'booking_type' => ['required', 'in:existing,custom'],
            'hike_id' => ['nullable', 'exists:hikes,id'],
            'trek_date' => $isCustomBooking ? ['nullable'] : ['required', 'date', 'after:today'],
            'start_time' => $isCustomBooking ? ['nullable'] : ['required', 'date_format:H:i'],
            'custom_trek_date' => $isCustomBooking ? ['required', 'date', 'after:today'] : ['nullable', 'date', 'after:today'],
            'custom_start_time' => $isCustomBooking ? ['required', 'date_format:H:i'] : ['nullable', 'date_format:H:i'],
            'custom_trail' => $isCustomBooking ? ['required', 'string'] : ['nullable', 'string'],
            'custom_trail_name' => ['nullable', 'string', 'max:255'],
            'local_tourists' => ['required', 'integer', 'min:0'],
            'foreign_tourists' => ['required', 'integer', 'min:0'],
            'foreign_nationalities' => ['nullable', 'string', 'required_if:foreign_tourists,>,0'],
            'length_of_stay' => ['required', 'in:day_hike,overnight,other'],
            'transportation' => ['required', 'in:own_vehicle,rent_trike'],
            'health_issues' => ['nullable', 'array'],
            'other_health_issues' => ['nullable', 'string', 'max:255'],
            'payment_method' => ['required', Rule::in($paymentMethods)],
            'terms_agreed' => ['required', 'accepted'],
            'meeting_place' => ['required', 'in:tourism_office,museum'],
            'special_requests' => ['nullable', 'string', 'max:500'],
        ]);

        // Use custom fields if it's a custom booking
        if ($isCustomBooking) {
            $validated['trek_date'] = $validated['custom_trek_date'];
            $validated['start_time'] = $validated['custom_start_time'];
            
            // Handle trail selection
            if ($validated['custom_trail'] === 'Custom Trail') {
                if (empty($validated['custom_trail_name'])) {
                    return back()
                        ->withInput()
                        ->withErrors(['custom_trail_name' => 'Custom trail name is required when selecting "Other".']);
                }
                $trail = $validated['custom_trail_name'];
            } else {
                $trail = $validated['custom_trail'];
            }
            
            // Validate custom booking fields
            if (empty($validated['trek_date']) || empty($validated['start_time']) || empty($trail)) {
                return back()
                    ->withInput()
                    ->withErrors(['custom_booking' => 'All custom booking fields (date, time, trail) are required.']);
            }
        } else {
            // For existing hike bookings, get trail from hike
            if ($validated['hike_id']) {
                $hike = \App\Models\Hike::find($validated['hike_id']);
                $trail = $hike ? $hike->trail : 'Sta. Clara Trail (Back-Trail Only)';
            } else {
                $trail = 'Sta. Clara Trail (Back-Trail Only)'; // Default trail
            }
        }

        // Validate start time based on length of stay
        $startTime = \Carbon\Carbon::createFromFormat('H:i', $validated['start_time']);
        if ($validated['length_of_stay'] === 'day_hike') {
            $allowedTimes = ['05:30', '06:00', '07:00'];
            if (!in_array($validated['start_time'], $allowedTimes)) {
                return back()
                    ->withInput()
                    ->withErrors(['start_time' => 'For Day Hike, start time must be 5:30 AM, 6:00 AM, or 7:00 AM.']);
            }
        } elseif ($validated['length_of_stay'] === 'overnight') {
            $minTime = \Carbon\Carbon::createFromFormat('H:i', '10:00');
            $maxTime = \Carbon\Carbon::createFromFormat('H:i', '13:00');
            if ($startTime->lt($minTime) || $startTime->gt($maxTime)) {
                return back()
                    ->withInput()
                    ->withErrors(['start_time' => 'For Overnight, start time must be between 10:00 AM and 1:00 PM.']);
            }
        }

        $totalTourists = $validated['local_tourists'] + $validated['foreign_tourists'];
        
        if ($totalTourists <= 0) {
            return back()
                ->withInput()
                ->withErrors(['tourists' => 'You must book for at least one tourist.']);
        }

        // For existing hike bookings, check capacity
        if ($validated['hike_id']) {
            $hike = \App\Models\Hike::find($validated['hike_id']);
            if ($hike && ($hike->current_bookings + $totalTourists) > $hike->capacity) {
                return back()
                    ->withInput()
                    ->withErrors(['capacity' => 'Not enough slots available for this hike. Available slots: ' . ($hike->capacity - $hike->current_bookings)]);
            }
        }

        // Calculate fees based on tourist types
        $localFee = $validated['local_tourists'] * 180; // Residents
        $foreignFee = $validated['foreign_tourists'] * 350; // Foreigners
        $touristFee = $localFee + $foreignFee;
        
        // Tricycle fee: ₱800 round trip, up to 4 persons
        $tricycleFee = $validated['transportation'] === 'rent_trike' ? 800 : 0;
        
        $totalAmount = $touristFee + $tricycleFee;

        // Calculate processing fee
        $paymentMethod = PaymentMethod::where('code', $validated['payment_method'])->firstOrFail();
        $processingFee = $paymentMethod->calculateProcessingFee($totalAmount);
        $totalAmount += $processingFee;

        // Calculate down payment (50% of tourist fee per group)
        $downPayment = $touristFee * 0.5;

        $booking = Booking::create([
            'user_id' => Auth::id(),
            'hike_id' => $validated['hike_id'], // Use the selected hike ID
            'trek_date' => $validated['trek_date'],
            'start_time' => $validated['start_time'],
            'trail' => $trail, // Use the determined trail (from hike or custom)
            'guide_id' => null, // Will be assigned by admin
            'porter_id' => null, // Will be assigned by admin
            'foreign_tourists' => $validated['foreign_tourists'],
            'local_tourists' => $validated['local_tourists'],
            'foreign_nationalities' => $validated['foreign_nationalities'] ? 
                array_map('trim', explode(',', $validated['foreign_nationalities'])) : null,
            'length_of_stay' => $validated['length_of_stay'],
            'transportation' => $validated['transportation'],
            'tricycle_rental' => $validated['transportation'] === 'rent_trike',
            'tricycle_fee' => $tricycleFee,
            'health_issues' => array_merge(
                $validated['health_issues'] ?? [],
                $validated['other_health_issues'] ? ['other' => $validated['other_health_issues']] : []
            ),
            'tourist_fee' => $touristFee,
            'guide_fee' => 0, // Will be calculated when admin assigns guide
            'porter_fee' => 0, // Will be calculated when admin assigns porter
            'processing_fee' => $processingFee,
            'total_amount' => $totalAmount,
            'down_payment' => $downPayment,
            'payment_method' => $validated['payment_method'],
            'meeting_place' => $validated['meeting_place'],
            'terms_agreed' => true,
            'special_requests' => $validated['special_requests'],
            'status' => $isCustomBooking ? 'pending' : 'payment_pending'
        ]);

        \Log::info('Booking created successfully', [
            'booking_id' => $booking->id,
            'trek_date' => $validated['trek_date'],
            'tourists' => $totalTourists,
            'user_id' => auth()->id()
        ]);

        // Redirect based on booking type
        if ($isCustomBooking) {
            return redirect()
                ->route('user.bookings.show', $booking)
                ->with('success', 'Custom booking submitted successfully. Please wait for admin approval before proceeding with payment.');
        } else {
            return redirect()
                ->route('user.bookings.payment', $booking)
                ->with('success', 'Booking created successfully. Please proceed with the payment.');
        }
    }

    public function payment(Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        if ($booking->status !== 'payment_pending') {
            return redirect()->route('user.bookings.show', $booking);
        }

        $paymentMethod = PaymentMethod::where('code', $booking->payment_method)->firstOrFail();
        return view('user.bookings.payment', compact('booking', 'paymentMethod'));
    }

    /**
     * Process payment verification with receipt upload.
     */
    public function verifyPayment(Request $request, Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        if ($booking->status !== 'payment_pending') {
            return redirect()
                ->route('user.bookings.show', $booking)
                ->with('error', 'This booking is not pending payment verification.');
        }

        $validated = $request->validate([
            'transaction_id' => ['required', 'string', 'max:255'],
            'receipt_image' => ['required', 'image', 'max:5120'], // 5MB max
        ]);

        try {
            // Store receipt image
            if (!Storage::disk('public')->exists('receipts')) {
                Storage::disk('public')->makeDirectory('receipts');
            }

            $receiptImage = $request->file('receipt_image');
            $receiptPath = $receiptImage->storeAs(
                'receipts',
                'receipt_' . time() . '_' . $booking->id . '.' . $receiptImage->getClientOriginalExtension(),
                'public'
            );

            if (!$receiptPath) {
                throw new \Exception('Failed to store receipt image');
            }

            // Update or create payment record
            $payment = Payment::updateOrCreate(
                ['booking_id' => $booking->id],
                [
                    'amount' => $booking->total_amount,
                    'payment_method' => $booking->payment_method,
                    'transaction_id' => $validated['transaction_id'],
                    'receipt_url' => Storage::disk('public')->url($receiptPath),
                    'status' => 'pending',
                    'payment_data' => [
                        'submitted_at' => now()->toDateTimeString(),
                        'user_notes' => $request->input('notes'),
                    ],
                ]
            );

            // Update booking status to payment verification pending for admin review
            $booking->update([
                'status' => 'payment_verification_pending'
            ]);

            // Log the payment submission
            Log::info('Payment proof submitted', [
                'booking_id' => $booking->id,
                'payment_id' => $payment->id,
                'user_id' => Auth::id(),
                'amount' => $booking->total_amount,
            ]);

            return redirect()
                ->route('user.bookings.show', $booking)
                ->with('success', 'Payment proof submitted successfully. We will verify your payment within 24 hours.');

        } catch (\Exception $e) {
            Log::error('Payment proof submission failed', [
                'booking_id' => $booking->id,
                'error' => $e->getMessage(),
            ]);

            return back()
                ->withInput()
                ->with('error', 'Failed to submit payment proof. Please try again.');
        }
    }

    public function show(Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $booking->load(['hike', 'guide', 'porter', 'payments']);
        return view('user.bookings.show', compact('booking'));
    }

    public function processPayment(Request $request, Booking $booking, PaymentService $paymentService)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        if ($booking->status !== 'payment_pending') {
            return redirect()->route('user.bookings.show', $booking);
        }

        try {
            $validated = $request->validate([
                'payment_reference' => ['required', 'string', 'max:255'],
            ]);

            $paymentData = [
                'reference' => $validated['payment_reference'],
                'amount' => $booking->down_payment,
            ];

            $payment = $paymentService->processPayment($booking, $paymentData);

            $booking->update([
                'payment_reference' => $validated['payment_reference'],
                'status' => 'payment_verification_pending'
            ]);

            return redirect()
                ->route('user.bookings.show', $booking)
                ->with('success', 'Payment processed successfully. Please wait for admin approval.');

        } catch (\Exception $e) {
            Log::error('Payment Processing Error: ' . $e->getMessage(), [
                'booking_id' => $booking->id,
                'payment_method' => $booking->payment_method,
                'error' => $e->getMessage()
            ]);

            return back()
                ->withInput()
                ->withErrors(['payment' => 'Payment processing failed. Please try again.']);
        }
    }

    public function cancel(Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        if (!in_array($booking->status, ['pending', 'approved'])) {
            return back()->with('error', 'Cannot cancel this booking.');
        }

        try {
            // If the booking has a verified payment, process refund
            if ($booking->payment && $booking->payment->verified_at && !$booking->payment->refunded) {
                $paymentService = new PaymentService();
                $refunded = $paymentService->processRefund($booking->payment);

                if (!$refunded) {
                    return back()->with('error', 'Failed to process refund. Please contact support.');
                }

                $booking->update([
                    'status' => 'cancelled',
                    'cancellation_reason' => request('reason'),
                ]);

                // Decrease the hike's current bookings count
                $booking->hike->decrement('current_bookings', 
                    $booking->foreign_tourists + $booking->local_tourists);

                return redirect()->route('user.bookings.index')
                    ->with('success', 'Booking cancelled and refund initiated successfully. Please allow 3-5 business days for the refund to be processed.');
            }

            // If no payment or payment not verified, just cancel the booking
            $booking->update([
                'status' => 'cancelled',
                'cancellation_reason' => request('reason'),
            ]);

            // Decrease the hike's current bookings count
            $booking->hike->decrement('current_bookings', 
                $booking->foreign_tourists + $booking->local_tourists);

            return redirect()->route('user.bookings.index')
                ->with('success', 'Booking cancelled successfully.');
        } catch (\Exception $e) {
            \Log::error('Booking cancellation failed: ' . $e->getMessage());
            return back()->with('error', 'Failed to cancel booking. Please try again or contact support.');
        }
    }
}