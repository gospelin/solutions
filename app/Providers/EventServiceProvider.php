<?php

namespace App\Providers;

use App\Events\MarketItemCreated;
use App\Events\FreeAppCreated;
use App\Events\FreeAppUpdated;
use App\Events\UserNotification;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Event::listen(MarketItemCreated::class, function (MarketItemCreated $event) {
            $users = User::where('notifications', true)->get();
            foreach ($users as $user) {
                $notification = Notification::create([
                    'user_id' => $user->id,
                    'type' => 'New Tool',
                    'message' => "New tool added: {$event->item->name}",
                    'read' => false,
                ]);
                event(new UserNotification($notification));
            }
        });

        Event::listen(FreeAppCreated::class, function (FreeAppCreated $event) {
            $users = User::where('notifications', true)->get();
            foreach ($users as $user) {
                $notification = Notification::create([
                    'user_id' => $user->id,
                    'type' => 'New Free App',
                    'message' => "New free app added: {$event->freeApp->name}",
                    'read' => false,
                ]);
                event(new UserNotification($notification));
            }
        });

        Event::listen(FreeAppUpdated::class, function (FreeAppUpdated $event) {
            $users = User::where('notifications', true)->get();
            foreach ($users as $user) {
                $notification = Notification::create([
                    'user_id' => $user->id,
                    'type' => 'Free App Updated',
                    'message' => "Free app updated: {$event->freeApp->name}",
                    'read' => false,
                ]);
                event(new UserNotification($notification));
            }
        });
    }
}
