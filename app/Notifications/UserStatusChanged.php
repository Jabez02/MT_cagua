<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\User;

class UserStatusChanged extends Notification implements ShouldQueue
{
    use Queueable;

    protected $user;
    protected $newStatus;

    /**
     * Create a new notification instance.
     */
    public function __construct(User $user, string $newStatus)
    {
        $this->user = $user;
        $this->newStatus = $newStatus;
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
        $statusMessages = [
            'approved' => 'Your Mt. Cagua Hiking account has been approved! You can now log in and start booking hikes.',
            'rejected' => 'Your Mt. Cagua Hiking account registration has been rejected. Please contact support for more information.',
            'pending' => 'Your Mt. Cagua Hiking account status has been set to pending review.',
        ];

        $message = $statusMessages[$this->newStatus] ?? 'Your Mt. Cagua Hiking account status has been updated.';

        return (new MailMessage)
            ->subject('Mt. Cagua Hiking - Account Status Update')
            ->greeting('Hello ' . $this->user->name . '!')
            ->line($message)
            ->line('If you have any questions, please don\'t hesitate to contact us.')
            ->action('Visit Website', url('/'))
            ->line('Thank you for choosing Mt. Cagua Hiking!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'user_id' => $this->user->id,
            'status' => $this->newStatus,
            'message' => 'Your account status has been updated to ' . $this->newStatus,
        ];
    }
}