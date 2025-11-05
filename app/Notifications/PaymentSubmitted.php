<?php

namespace App\Notifications;

use App\Models\Payment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PaymentSubmitted extends Notification implements ShouldQueue
{
    use Queueable;

    protected $payment;

    /**
     * Create a new notification instance.
     */
    public function __construct(Payment $payment)
    {
        $this->payment = $payment;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $booking = $this->payment->booking;

        return (new MailMessage)
            ->subject('Payment Submitted - Mt. Cagua Booking')
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line('We received your payment proof for booking #' . $booking->id . '.')
            ->line('Our team will verify your payment within 24 hours.')
            ->line('Payment Details:')
            ->line('- Amount: ₱' . number_format($this->payment->amount, 2))
            ->line('- Method: ' . ucfirst($this->payment->payment_method))
            ->line('- Transaction ID: ' . ($this->payment->transaction_id ?? 'N/A'))
            ->line('- Submitted at: ' . now()->format('M d, Y h:i A'))
            ->action('View Booking Details', route('user.bookings.show', $booking))
            ->line('We will notify you once verification is complete.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        $booking = $this->payment->booking;
        return [
            'title' => 'Payment Submitted',
            'message' => 'Your payment proof has been submitted and is pending verification.',
            'payment_id' => $this->payment->id,
            'booking_id' => $booking->id,
            'amount' => $this->payment->amount,
            'payment_method' => $this->payment->payment_method,
            'transaction_id' => $this->payment->transaction_id,
            'status' => 'pending_verification',
            'submitted_at' => now(),
            'action_url' => route('user.bookings.show', $booking),
        ];
    }
}