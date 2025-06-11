<?php

namespace App\Listeners;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Mail\Events\MessageSent;
use Illuminate\Support\Facades\Log;

class MessageSentListener
{
    public function handle(MessageSent $event)
    {
        $recipients = array_keys($event->message->getTo());
        $subject = $event->message->getSubject();

        $admins = User::role(['admin', 'superAdmin'])->where('notifications', true)->get();
        foreach ($admins as $admin) {
            Notification::create([
                'user_id' => $admin->id,
                'type' => 'Email Sent',
                'message' => "Email sent with subject '{$subject}' to " . implode(', ', $recipients) . ".",
            ]);
        }

        Log::info('Email sent notification created', [
            'subject' => $subject,
            'recipients' => $recipients,
        ]);
    }
}