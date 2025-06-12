<?php

namespace App\Events;

use App\Models\Notification;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserNotification implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $notification;

    public function __construct(Notification $notification)
    {
        $this->notification = $notification;
    }

    public function broadcastOn()
    {
        return new Channel("user.{$this->notification->user_id}");
    }

    public function broadcastWith()
    {
        $icons = [
            'New Tool' => 'bi-tools',
            'New Free App' => 'bi-app',
            'Free App Updated' => 'bi-arrow-repeat',
        ];
        return [
            'notification' => [
                'id' => $this->notification->id,
                'type' => $this->notification->type,
                'message' => $this->notification->message,
                'created_at' => $this->notification->created_at->toIso8601String(),
                'icon' => $icons[$this->notification->type] ?? 'bi-bell',
                
            ]
        ];
    }
}
