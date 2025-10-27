<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class CustomVerifyEmail extends VerifyEmail implements ShouldQueue
{
    use Queueable;

    /**
     * Build the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $verificationUrl = $this->verificationUrl($notifiable);

        return (new MailMessage)
            ->subject('Welcome to Mt. Cagua Hiking - Verify Your Email')
            ->greeting('Hello ' . $notifiable->name . '!')
            ->line('Welcome to Mt. Cagua Hiking! We\'re excited to have you join our community of adventurers.')
            ->line('Before you can start planning your hike, please verify your email address by clicking the button below:')
            ->action('Verify Email Address', $verificationUrl)
            ->line('This verification link will expire in 60 minutes.')
            ->line('If you did not create an account, no further action is required.')
            ->line('Happy hiking!')
            ->salutation('Best regards,')
            ->salutation('The Mt. Cagua Hiking Team');
    }
}