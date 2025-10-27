<?php

namespace App\Notifications;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CustomBookingApproved extends Notification implements ShouldQueue
{
    use Queueable;

    protected $booking;

    /**
     * Create a new notification instance.
     */
    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
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
            ->subject('Custom Booking Approved - Mt. Cagua')
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line('Great news! Your custom booking request #' . $this->booking->id . ' has been approved.')
            ->line('Booking Details:')
            ->line('- Trail: ' . $this->booking->trail)
            ->line('- Date: ' . $this->booking->trek_date->format('M d, Y'))
            ->line('- Start Time: ' . $this->booking->start_time)
            ->line('- Total Amount: ₱' . number_format($this->booking->total_amount, 2))
            ->line('You can now proceed with payment to confirm your booking.')
            ->action('Make Payment', route('user.bookings.show', $this->booking))
            ->line('Please complete your payment within 24 hours to secure your booking.')
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
            'title' => 'Custom Booking Approved',
            'message' => 'Your custom booking request #' . $this->booking->id . ' has been approved. You can now proceed with payment.',
            'booking_id' => $this->booking->id,
            'trail' => $this->booking->trail,
            'trek_date' => $this->booking->trek_date,
            'start_time' => $this->booking->start_time,
            'total_amount' => $this->booking->total_amount,
            'action_url' => route('user.bookings.show', $this->booking),
        ];
    }
}