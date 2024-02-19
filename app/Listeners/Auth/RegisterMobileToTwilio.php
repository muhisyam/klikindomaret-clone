<?php

namespace App\Listeners\Auth;

use App\Events\Auth\MobileVerify;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Register mobile to Verify Id list in Twilio.
 */
class RegisterMobileToTwilio implements ShouldQueue
{
    public function handle(MobileVerify $event): void
    {
        $event->twilio->validationRequests->create(
            $event->attributes['target_number'],
            [
                "friendlyName" => substr($event->attributes['target_number'], 0)
            ]
        );
    }

    public function shouldQueue(MobileVerify $event): bool
    {
        return $event->attributes['register_to_twilio'];
    }
}
