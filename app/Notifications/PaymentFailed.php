<?php

namespace App\Notifications;

use App\Models\Payment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PaymentFailed extends Notification implements ShouldQueue
{
    use Queueable;

    protected $payment;
    protected $reason;

    /**
     * Create a new notification instance.
     */
    public function __construct(Payment $payment, string $reason)
    {
        $this->payment = $payment;
        $this->reason = $reason;
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
            ->subject('Payment Failed - Mt. Cagua Hiking Booking')
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line('We were unable to verify your payment for booking #' . $booking->id . '.')
            ->line('Payment Details:')
            ->line('- Amount: ₱' . number_format($this->payment->amount, 2))
            ->line('- Method: ' . ucfirst($this->payment->payment_method))
            ->line('- Transaction ID: ' . $this->payment->transaction_id)
            ->line('Reason for failure: ' . $this->reason)
            ->line('Please try submitting your payment again or contact our support team if you believe this is an error.')
            ->action('Submit Payment Again', route('user.bookings.payment', $booking))
            ->line('Thank you for your understanding.');
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
            'title' => 'Payment Failed',
            'message' => 'Your payment of ₱' . number_format($this->payment->amount, 2) . ' for booking #' . $booking->id . ' could not be verified.',
            'booking_id' => $booking->id,
            'payment_id' => $this->payment->id,
            'amount' => $this->payment->amount,
            'payment_method' => $this->payment->payment_method,
            'transaction_id' => $this->payment->transaction_id,
            'reason' => $this->reason,
            'action_url' => route('user.bookings.payment', $booking),
        ];
    }
}