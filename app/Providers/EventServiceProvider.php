<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Mail\Events\MessageSent;
use App\Listeners\MessageSentListener;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        MessageSent::class => [
            MessageSentListener::class,
        ],
    ];

    public function boot()
    {
        //
    }
}