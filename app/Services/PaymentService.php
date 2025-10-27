<?php

namespace App\Services;

use App\Models\Booking;
use App\Models\Payment;
use App\Models\PaymentMethod;
use App\Services\ReceiptService;
use Exception;
use Illuminate\Support\Facades\Log;

class PaymentService
{
    protected $gcashEndpoint;
    protected $bankEndpoint;
    protected $apiKey;

    public function __construct()
    {
        $this->gcashEndpoint = config('payment.gcash.endpoint');
        $this->bankEndpoint = config('payment.bank.endpoint');
        $this->apiKey = config('payment.api_key');
    }

    public function processGCashPayment(Booking $booking, array $paymentData)
    {
        try {
            // Simulate GCash payment processing
            $response = [
                'success' => true,
                'transaction_id' => 'GCASH_' . uniqid(),
                'amount' => $booking->total_amount,
                'status' => 'completed'
            ];

            if ($response['success']) {
                return $this->createPaymentRecord($booking, $response, 'gcash');
            }

            throw new Exception('GCash payment processing failed');
        } catch (Exception $e) {
            Log::error('GCash Payment Error: ' . $e->getMessage());
            throw $e;
        }
    }

    public function processBankTransfer(Booking $booking, array $paymentData)
    {
        try {
            // Simulate bank transfer processing
            $response = [
                'success' => true,
                'transaction_id' => 'BANK_' . uniqid(),
                'amount' => $booking->total_amount,
                'status' => 'pending_verification'
            ];

            if ($response['success']) {
                return $this->createPaymentRecord($booking, $response, 'bank_transfer');
            }

            throw new Exception('Bank transfer processing failed');
        } catch (Exception $e) {
            Log::error('Bank Transfer Error: ' . $e->getMessage());
            throw $e;
        }
    }

    public function processPayment(Booking $booking, array $paymentData)
    {
        try {
            $paymentMethod = PaymentMethod::where('code', $booking->payment_method)->firstOrFail();
    
            // Validate amount against payment method limits
            if (!$paymentMethod->isAvailableForAmount($paymentData['amount'])) {
                throw new Exception('Amount is outside the allowed range for this payment method.');
            }
    
            // Simulate payment processing using payment method configuration
            $response = [
                'success' => true,
                'transaction_id' => strtoupper($paymentMethod->code) . '_' . uniqid(),
                'amount' => $paymentData['amount'],
                'status' => $paymentMethod->configuration['requires_verification'] ?? false ? 'pending_verification' : 'completed'
            ];
    
            if ($response['success']) {
                return $this->createPaymentRecord($booking, $response, $paymentMethod->code);
            }
    
            throw new Exception('Payment processing failed');
        } catch (Exception $e) {
            Log::error('Payment Processing Error: ' . $e->getMessage(), [
                'booking_id' => $booking->id,
                'payment_method' => $booking->payment_method,
                'amount' => $paymentData['amount']
            ]);
            throw $e;
        }
    }

    protected function createPaymentRecord(Booking $booking, array $response, string $method)
    {
        return Payment::create([
            'booking_id' => $booking->id,
            'transaction_id' => $response['transaction_id'],
            'amount' => $response['amount'],
            'payment_method' => $method,
            'status' => $response['status'],
            'payment_data' => json_encode($response)
        ]);
    }

    public function verifyPayment(Payment $payment, $receiptPath = null)
    {
        try {
            $paymentMethod = PaymentMethod::where('code', $payment->payment_method)->firstOrFail();
    
            // Update payment status to pending verification
            $payment->update([
                'status' => 'pending_verification',
                'receipt_url' => $receiptPath ? Storage::url($receiptPath) : null,
                'payment_data' => array_merge($payment->payment_data ?? [], [
                    'submitted_at' => now()->toDateTimeString(),
                ])
            ]);
    
            // Update booking status
            $payment->booking->update([
                'status' => 'pending_verification'
            ]);
    
            // Send notification to user
            $payment->booking->user->notify(new \App\Notifications\PaymentSubmitted($payment));
    
            // Log the payment submission
            Log::info('Payment proof submitted', [
                'payment_id' => $payment->id,
                'booking_id' => $payment->booking_id,
                'user_id' => $payment->booking->user_id,
                'amount' => $payment->amount,
            ]);
    
            return true;
        } catch (Exception $e) {
            Log::error('Payment Verification Error: ' . $e->getMessage(), [
                'payment_id' => $payment->id,
                'payment_method' => $payment->payment_method
            ]);
            throw $e;
        }
    }

    public function processRefund(Payment $payment)
    {
        try {
            $paymentMethod = PaymentMethod::where('code', $payment->payment_method)->firstOrFail();
    
            // Check if refund is allowed based on payment method configuration
            if (!($paymentMethod->configuration['allows_refund'] ?? true)) {
                throw new Exception('Refunds are not supported for this payment method.');
            }
    
            // Simulate refund processing
            $refunded = true;
            $refundId = 'REF_' . uniqid();
    
            if ($refunded) {
                $payment->update([
                    'refunded' => true,
                    'refund_id' => $refundId,
                    'refunded_at' => now()
                ]);
    
                // Send refund notification
                $payment->booking->user->notify(new \App\Notifications\PaymentRefunded($payment));
    
                return true;
            }
    
            return false;
        } catch (Exception $e) {
            Log::error('Payment refund failed: ' . $e->getMessage(), [
                'payment_id' => $payment->id,
                'payment_method' => $payment->payment_method
            ]);
            throw new Exception('Failed to process refund: ' . $e->getMessage());
        }
    }
}