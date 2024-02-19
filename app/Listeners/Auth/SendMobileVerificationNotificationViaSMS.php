<?php

namespace App\Listeners\Auth;

use App\Events\Auth\MobileVerify;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMobileVerificationNotificationViaSMS implements ShouldQueue
{
    public $sender;

    public function __construct()
    {
        $this->sender = config('services.twilio.active_phone');
    }

    public function handle(MobileVerify $event): void
    {
        $event->twilio->messages->create(
            $event->attributes['target_number'],
            [
                'from' => $this->sender,
                'body' => $event->attributes['otp'] . ' adalah kode verifikasi akun KlikIndomaret anda. Demi keamanan jangan bagikan kode ini ke siapapun.',
            ]
        );
    }

    public function shouldQueue(MobileVerify $event): bool
    {
        return $event->attributes['via'] === 'sms';
    }
}
