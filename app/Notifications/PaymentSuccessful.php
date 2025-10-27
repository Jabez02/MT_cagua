<?php

namespace App\Notifications;

use App\Models\Payment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PaymentSuccessful extends Notification implements ShouldQueue
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
            ->subject('Payment Successful - Mt. Cagua Hiking Booking')
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line('Your payment for booking #' . $booking->id . ' has been successfully verified.')
            ->line('Payment Details:')
            ->line('- Amount: ₱' . number_format($this->payment->amount, 2))
            ->line('- Method: ' . ucfirst($this->payment->payment_method))
            ->line('- Transaction ID: ' . $this->payment->transaction_id)
            ->line('- Verified at: ' . $this->payment->verified_at->format('M d, Y h:i A'))
            ->line('Your booking is now pending approval from our administrators.')
            ->action('View Booking Details', route('user.bookings.show', $booking))
            ->line('You can download your receipt from the booking details page or click the link below:')
            ->action('Download Receipt', $this->payment->receipt_url)
            ->line('Thank you for choosing Mt. Cagua for your hiking adventure!');
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
            'title' => 'Payment Successful',
            'message' => 'Your payment of ₱' . number_format($this->payment->amount, 2) . ' for booking #' . $booking->id . ' has been verified.',
            'booking_id' => $booking->id,
            'payment_id' => $this->payment->id,
            'amount' => $this->payment->amount,
            'payment_method' => $this->payment->payment_method,
            'transaction_id' => $this->payment->transaction_id,
            'verified_at' => $this->payment->verified_at,
            'receipt_url' => $this->payment->receipt_url,
            'action_url' => route('user.bookings.show', $booking),
        ];
    }
}