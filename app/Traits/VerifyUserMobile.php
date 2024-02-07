<?php

namespace App\Traits;

use Twilio\Rest\Client;

trait VerifyUserMobile
{
    public $otpCode;
    
    public function verifyMobile()
    {
        $this->otpCode = $this->createOTP();

        // $this->sendMobileVerificationNotification();
    }

    protected function createOTP()
    {
        return mt_rand(111111, 999999);
    }

    public function sendMobileVerificationNotification()
    {
        $twilio = new Client(getenv('TWILIO_ACCOUNT_SID'), getenv('TWILIO_AUTH_TOKEN'));

        $twilio->messages->create(
            'whatsapp:+6281298232264',
            [
                'from' => 'whatsapp:+14155238886',
                'body' => '*' . $this->otpCode . '* adalah kode verifikasi anda. *Demi keamanan, jangan bagikan kode ini.*',
            ]
        );
    }
}