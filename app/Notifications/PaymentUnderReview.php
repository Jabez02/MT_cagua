<?php

namespace App\Notifications;

use App\Models\Payment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PaymentUnderReview extends Notification implements ShouldQueue
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
        return (new MailMessage)
            ->subject('Payment Under Review - Mt. Cagua Booking')
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line('Your payment of ₱' . number_format($this->payment->amount, 2) . ' for booking #' . $this->payment->booking_id . ' requires review.')
            ->line('Our team has flagged this payment for the following reason:')
            ->line($this->payment->payment_data['review_reason'])
            ->line('We will contact you shortly for further information.')
            ->action('View Booking Details', route('user.bookings.show', $this->payment->booking_id))
            ->line('If you have any questions, please contact our support team.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'payment_id' => $this->payment->id,
            'booking_id' => $this->payment->booking_id,
            'amount' => $this->payment->amount,
            'review_reason' => $this->payment->payment_data['review_reason'],
            'message' => 'Your payment requires review. We will contact you shortly.',
            'action_url' => route('user.bookings.show', $this->payment->booking_id),
        ];
    }
}