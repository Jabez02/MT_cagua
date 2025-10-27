<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\User;

class NewUserRegistered extends Notification implements ShouldQueue
{
    use Queueable;

    protected $newUser;

    /**
     * Create a new notification instance.
     */
    public function __construct(User $newUser)
    {
        $this->newUser = $newUser;
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
            ->subject('Mt. Cagua Hiking - New User Registration')
            ->greeting('Hello Admin!')
            ->line('A new user has registered on Mt. Cagua Hiking.')
            ->line('User Details:')
            ->line('Name: ' . $this->newUser->name)
            ->line('Email: ' . $this->newUser->email)
            ->line('Nationality: ' . $this->newUser->nationality)
            ->action('Review User', url('/admin/manage-users'))
            ->line('Please review their registration and take appropriate action.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'new_user_id' => $this->newUser->id,
            'new_user_name' => $this->newUser->name,
            'new_user_email' => $this->newUser->email,
            'message' => 'New user registration: ' . $this->newUser->name,
        ];
    }
}