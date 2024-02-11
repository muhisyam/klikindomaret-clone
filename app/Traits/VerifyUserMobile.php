<?php

namespace App\Traits;

use App\Actions\ErrorTraceAction;
use App\Http\Requests\VerifyMobileRequest;
use App\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Twilio\Rest\Client;

trait VerifyUserMobile
{
    protected $request, $twilio, $targetFormattedNumber, $otpCode;

    public function __construct()
    {
        $this->twilio = new Client(
            getenv('TWILIO_ACCOUNT_SID'), 
            getenv('TWILIO_AUTH_TOKEN')
        );
    }
    
    /**
     * Attempt mobile to get otp code.
     */
    public function verify(VerifyMobileRequest $request): void
    {
        $this->request = $request;
        $this->ensureIsNotInDatabase();
        $this->ensureIsNotRateLimited();
        
        $this->targetFormattedNumber = $this->formatFirstNumberCode($request['mobile_number']);
        $this->otpCode = $this->createOTP();

        $this->sendMobileVerificationNotification();
    }

    /**
     * Ensure the mobile is not exist in database.
     */
    protected function ensureIsNotInDatabase(): void 
    {
        if (! User::where('mobile_number', $this->request['mobile_number'])->first()) {
            return;
        }

        $trace = app(ErrorTraceAction::class)->execute();
        $this->sendMobileAlreadyExists($trace);
    }

    /**
     * Send response when mobile detected exist in database.
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

    /**
     * Ensure the mobile request is not rate limited.
     */
    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 3)) {
            return RateLimiter::hit($this->throttleKey());
        }

        // TODO: change event lockout
        // event(new Lockout($this)); 

        $trace = app(ErrorTraceAction::class)->execute();
        $this->sendTooManyMobileAttempts($trace);
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->request['mobile_number']) . '|' . $this->request->getClientIp());
    }

    /**
     * Send response when Rate Limiter detect too many attempts failed.
     *
     * @throws \Illuminate\Http\Exceptions\HttpResponseException
     */
    protected function sendTooManyMobileAttempts(array $trace): JsonResponse
    {
        $seconds = RateLimiter::availableIn($this->throttleKey());
        $message = 'Too many attempts. Please try again in ' . $seconds > 60 ? $seconds . ' seconds.' : ceil($seconds / 60) . ' minutes.';

        throw new HttpResponseException(response([
            'errors' => [
                'mobile_number' => $message,
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

    /**
     * Format mobile number to twilio format.
     */
    protected function formatFirstNumberCode(int $mobileNumber): string
    {
        $mobileNumber = substr($mobileNumber, 0);

        return '+62' . $mobileNumber;
    }

    /**
     * Get random otp code.
     */
    protected function createOTP(): int
    {
        return mt_rand(111111, 999999);
    }

    /**
     * Send a message that contain otp code to target.
     */
    // TODO: move to event listener? VerifyMobile?
    public function sendMobileVerificationNotification(): void
    {
        $this->twilio->messages->create(
            'whatsapp:' . $this->targetFormattedNumber,
            [
                'from' => 'whatsapp:+14155238886',
                'body' => '*' . $this->otpCode . '* adalah kode verifikasi anda. Demi keamanan, *jangan bagikan kode ini.*',
            ]
        );
    }

    /**
     * Register mobile to VerifyId list in Twilio.
     */
    public function sendMobileToTwilio(): void
    {
        $this->twilio->validationRequests->create(
            $this->targetFormattedNumber,
            [
                "friendlyName" => substr($this->targetFormattedNumber, 0)
            ]
        );
    }
}