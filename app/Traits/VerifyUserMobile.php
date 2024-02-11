<?php

namespace App\Traits;

use App\Actions\ErrorTraceAction;
use App\Http\Requests\VerifyMobileRequest;
use App\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Twilio\Rest\Client;

trait VerifyUserMobile
{
    public $twilio, $mobileNumber, $targetFormattedNumber, $otpCode;

    public function __construct()
    {
        $this->twilio = new Client(
            getenv('TWILIO_ACCOUNT_SID'), 
            getenv('TWILIO_AUTH_TOKEN')
        );
    }
    
    public function verify(VerifyMobileRequest $request)
    {
        $this->mobileNumber = $request['mobile_number'];
        $this->targetFormattedNumber = $this->formatFirstNumberCode($this->mobileNumber);
        $this->otpCode = $this->createOTP();

        $this->ensureIsNotInDatabase();
        // $this->sendMobileVerificationNotification();

        // TODO: make rate limiter throttle
    }

    // TODO: move to event listener? VerifyMobile?
    public function sendMobileVerificationNotification()
    {
        $this->twilio->messages->create(
            'whatsapp:' . $this->targetFormattedNumber,
            [
                'from' => 'whatsapp:+14155238886',
                'body' => '*' . $this->otpCode . '* adalah kode verifikasi anda. Demi keamanan, *jangan bagikan kode ini.*',
            ]
        );
    }

    public function sendMobileToTwilio()
    {
        $this->twilio->validationRequests->create(
            $this->targetFormattedNumber,
            [
                "friendlyName" => substr($this->targetFormattedNumber, 0)
            ]
        );
    }

    protected function formatFirstNumberCode(int $mobileNumber): string
    {
        $mobileNumber = substr($mobileNumber, 0);

        return '+62' . $mobileNumber;
    }

    protected function createOTP()
    {
        return mt_rand(111111, 999999);
    }

    protected function ensureIsNotInDatabase(): void 
    {
        if (! User::where('mobile_number', $this->mobileNumber)->first()) {
            return;
        }

        $trace = app(ErrorTraceAction::class)->execute();
        $this->sendMobileAlreadyExists($trace);
    }

    /**
     * Send response when Rate Limiter detect too many attempts failed.
     *
     * @throws \Illuminate\Http\Exceptions\HttpResponseException
     */
    protected function sendMobileAlreadyExists(array $trace): JsonResponse
    {
        throw new HttpResponseException(response([
            'errors' => [
                'mobile_number' => trans('validation.unique', [
                    'attribute' => 'Number',
                ]),
            ],
            'meta' => [
                'status_code' => 400,
                'message' => 'Bad Request',
                'trace' => [
                    'File' => $trace['filename'],
                    'Line' => $trace['line'],
                ],
            ],
        ])->setStatusCode(400));
    }
}