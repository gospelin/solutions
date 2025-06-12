<?php

namespace App\Jobs;

use App\Events\UserNotification;
use App\Models\MarketItem;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendMarketItemNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $item;

    public function __construct(MarketItem $item)
    {
        $this->item = $item;
    }

    public function handle()
    {
        User::where('notifications', true)->chunk(100, function ($users) {
            foreach ($users as $user) {
                $notification = Notification::create([
                    'user_id' => $user->id,
                    'type' => 'New Tool',
                    'message' => "New tool added: {$this->item->name}",
                    'read' => false,
                ]);
                event(new UserNotification($notification));
            }
        });
    }
}