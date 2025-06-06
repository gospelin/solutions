<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Log;

class VerifyEmail extends Notification implements ShouldQueue
{
    use Queueable;

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        if ($notifiable->hasRole('admin')) {
            return null; // Skip email verification for admins
        }

        if (!$notifiable->getKey() || !$notifiable->getEmailForVerification() || !$notifiable->verification_code) {
            Log::error('Invalid notifiable data for email verification', [
                'user_id' => $notifiable->getKey(),
                'email' => $notifiable->getEmailForVerification(),
                'otp' => $notifiable->verification_code,
            ]);
            return null;
        }

        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addHours(24),
            [
                'id' => $notifiable->getKey(),
                'hash' => sha1($notifiable->getEmailForVerification()),
            ],
            absolute: true
        );

        if (!str_starts_with($verificationUrl, config('app.url'))) {
            Log::warning('Verification URL generated with incorrect domain', [
                'user_id' => $notifiable->getKey(),
                'email' => $notifiable->getEmailForVerification(),
                'url' => $verificationUrl,
                'app_url' => config('app.url'),
            ]);
        }

        return (new MailMessage)
            ->subject('Verify Your Email')
            ->view('emails.verify', [
                'notifiable' => $notifiable,
                'verificationUrl' => $verificationUrl,
                'otpCode' => $notifiable->verification_code,
            ])
            ->text('emails.verify-text', [
                'notifiable' => $notifiable,
                'verificationUrl' => $verificationUrl,
                'otpCode' => $notifiable->verification_code,
            ]);
    }
}

