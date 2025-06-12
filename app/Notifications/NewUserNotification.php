<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewUserNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function build()
    {
        return $this->subject('New User Registered')
            ->view('emails.new-user')
            ->with([
                'name' => $this->user->name,
                //'email' => $this->user->email,
                'greeting' => 'Hello Admin,',
                'message' => 'A new user has registered on the platform.',
                
            ]);
    }
}