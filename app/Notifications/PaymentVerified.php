<?php

namespace App\Notifications;

use App\Models\Payment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PaymentVerified extends Notification implements ShouldQueue
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
            ->subject('Payment Verified - Mt. Cagua Booking')
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line('Your payment of ₱' . number_format($this->payment->amount, 2) . ' for booking #' . $this->payment->booking_id . ' has been verified.')
            ->line('Your booking is now confirmed.')
            ->action('View Booking Details', route('user.bookings.show', $this->payment->booking_id))
            ->line('Thank you for choosing Mt. Cagua for your adventure!');
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
            'message' => 'Your payment has been verified and your booking is confirmed.',
            'action_url' => route('user.bookings.show', $this->payment->booking_id),
        ];
    }
}