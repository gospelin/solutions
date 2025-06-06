<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReregisterNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Action Required: Re-register Your Account')
            ->greeting('Dear ' . ($notifiable->name ?? 'User') . ',')
            ->line('We have upgraded our platform to enhance security and user experience.')
            ->line('To continue using Premium Solutions, please re-register your account.')
            ->action('Re-register Now', url('/register'))
            ->line('If you have questions, contact support@solutions.com.ng.')
            ->line('Thank you for your understanding.');
    }
}