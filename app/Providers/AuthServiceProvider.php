<?php

namespace App\Providers;

use App\Notifications\VerifyEmail;
use Illuminate\Auth\Notifications\VerifyEmail as VerifyEmailNotification;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [];

    public function boot(): void
    {
        $this->registerPolicies();

        //VerifyEmailNotification::toMailUsing(function ($notifiable) {
        //    return (new VerifyEmail)->toMail($notifiable);
        //});
    }
}
