<?php

namespace App\Providers;

use App\Events\Auth\Authenticated;
use App\Events\Auth\Lockout;
use App\Events\Auth\MobileVerify;
use App\Listeners\Auth\AuthenticatedSession;
use App\Listeners\Auth\LockoutTraceNotification;
use App\Listeners\Auth\RegisterMobileToTwilio;
use App\Listeners\Auth\SendMobileVerificationNotificationViaSMS;
use App\Listeners\Auth\SendMobileVerificationNotificationViaWhatsapp;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        MobileVerify::class => [
            RegisterMobileToTwilio::class,
            SendMobileVerificationNotificationViaSMS::class,
            SendMobileVerificationNotificationViaWhatsapp::class,
        ],
        Lockout::class => [
            LockoutTraceNotification::class,
        ],
        Authenticated::class => [
            AuthenticatedSession::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
