<?php

namespace App\Notifications;

use App\Models\Payment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PaymentRejected extends Notification implements ShouldQueue
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
        $rejectionReason = $this->payment->payment_data['rejection_reason'] ?? 'No reason provided';
        
        return (new MailMessage)
            ->subject('Payment Rejected - Mt. Cagua Hiking Booking')
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line('Unfortunately, your payment for booking #' . $booking->id . ' has been rejected.')
            ->line('Payment Details:')
            ->line('- Amount: ₱' . number_format($this->payment->amount, 2))
            ->line('- Method: ' . ucfirst($this->payment->payment_method))
            ->line('- Transaction ID: ' . $this->payment->transaction_id)
            ->line('Reason for rejection: ' . $rejectionReason)
            ->line('Please review the rejection reason and submit a new payment if you wish to proceed with your booking.')
            ->action('Submit New Payment', route('user.bookings.payment', $booking))
            ->line('If you have any questions or believe this rejection was made in error, please contact our support team.')
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
        $rejectionReason = $this->payment->payment_data['rejection_reason'] ?? 'No reason provided';
        
        return [
            'title' => 'Payment Rejected',
            'message' => 'Your payment of ₱' . number_format($this->payment->amount, 2) . ' for booking #' . $booking->id . ' has been rejected.',
            'booking_id' => $booking->id,
            'payment_id' => $this->payment->id,
            'amount' => $this->payment->amount,
            'payment_method' => $this->payment->payment_method,
            'transaction_id' => $this->payment->transaction_id,
            'rejection_reason' => $rejectionReason,
            'action_url' => route('user.bookings.payment', $booking),
        ];
    }
}