<?php

namespace App\Listeners\Auth;

use App\Events\Auth\MobileVerify;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMobileVerificationNotificationViaWhatsapp implements ShouldQueue
{
    public function handle(MobileVerify $event): void
    {
        $event->twilio->messages->create(
            'whatsapp:' . $event->attributes['target_number'],
            [
                'from' => 'whatsapp:+14155238886',
                'body' => '*' . $event->attributes['otp'] . '* adalah kode verifikasi akun KlikIndomaret anda. Demi keamanan *jangan bagikan kode ini ke siapapun.*',
            ]
        );
    }

    public function shouldQueue(MobileVerify $event): bool
    {
        return $event->attributes['via'] === 'whatsapp';
    }
}
