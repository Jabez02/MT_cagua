<?php

namespace App\Notifications;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CustomBookingRejected extends Notification implements ShouldQueue
{
    use Queueable;

    protected $booking;
    protected $reason;

    /**
     * Create a new notification instance.
     */
    public function __construct(Booking $booking, string $reason = null)
    {
        $this->booking = $booking;
        $this->reason = $reason ?? 'No specific reason provided';
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
            ->subject('Custom Booking Request Declined - Mt. Cagua')
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line('We regret to inform you that your custom booking request #' . $this->booking->id . ' has been declined.')
            ->line('Booking Details:')
            ->line('- Trail: ' . $this->booking->trail)
            ->line('- Date: ' . $this->booking->trek_date->format('M d, Y'))
            ->line('- Start Time: ' . $this->booking->start_time)
            ->line('Reason for decline: ' . $this->reason)
            ->line('You can submit a new custom booking request with different details or contact our support team for assistance.')
            ->action('Create New Booking', route('user.bookings.create'))
            ->line('Thank you for your interest in Mt. Cagua hiking adventures.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Custom Booking Declined',
            'message' => 'Your custom booking request #' . $this->booking->id . ' has been declined. ' . $this->reason,
            'booking_id' => $this->booking->id,
            'trail' => $this->booking->trail,
            'trek_date' => $this->booking->trek_date,
            'start_time' => $this->booking->start_time,
            'reason' => $this->reason,
            'action_url' => route('user.bookings.create'),
        ];
    }
}