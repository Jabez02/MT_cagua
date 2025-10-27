<?php

namespace App\Notifications;

use App\Models\Payment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PaymentRefunded extends Notification implements ShouldQueue
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
            ->subject('Payment Refunded - Mt. Cagua Hiking Booking')
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line('Your payment for booking #' . $booking->id . ' has been refunded.')
            ->line('Refund Details:')
            ->line('- Amount: ₱' . number_format($this->payment->amount, 2))
            ->line('- Original Payment Method: ' . ucfirst($this->payment->payment_method))
            ->line('- Refund ID: ' . $this->payment->refund_id)
            ->line('- Refunded at: ' . $this->payment->refunded_at->format('M d, Y h:i A'))
            ->line('The refund will be processed through your original payment method. Please allow 3-5 business days for the refund to appear in your account.')
            ->action('View Booking Details', route('user.bookings.show', $booking))
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
            'title' => 'Payment Refunded',
            'message' => 'Your payment of ₱' . number_format($this->payment->amount, 2) . ' for booking #' . $booking->id . ' has been refunded.',
            'booking_id' => $booking->id,
            'payment_id' => $this->payment->id,
            'amount' => $this->payment->amount,
            'payment_method' => $this->payment->payment_method,
            'refund_id' => $this->payment->refund_id,
            'refunded_at' => $this->payment->refunded_at,
            'action_url' => route('user.bookings.show', $booking),
        ];
    }
}