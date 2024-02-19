<?php

namespace App\Traits;

use App\Actions\ErrorTraceAction;
use App\Events\Auth\MobileVerify;
use App\Http\Requests\Auth\VerifyMobileRequest;
use App\Http\Requests\Auth\VerifyOtpRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

trait VerifyUserMobile
{
    protected $request;
    
    /**
     * Attempt mobile to get otp code.
     */
    public function verify(VerifyMobileRequest $request): void
    {
        $this->request = $request;
        $this->ensureIsNotRateLimited();
        
        $targetNumber = $this->formatFirstNumberCode($request['mobile_number']);
        $otpCode = $this->createOTP();

        event(new MobileVerify([
            'register_to_twilio' => false, 
            'target_number' => $targetNumber, 
            'otp' => $otpCode,
            'via' => $request['via'],
        ]));
    }

    /**
     * Attempt otp code to verified mobile request.
     */
    public function verified(VerifyOtpRequest $request): void
    {
        $this->request = $request;
        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Ensure the mobile request is not rate limited.
     */
    public function ensureIsNotRateLimited(): mixed
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 3)) {
            // Set 300s for resend otp session 
            return RateLimiter::hit($this->throttleKey(), 300);
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
        $seconds = $seconds > 60 ? $seconds . ' seconds.' : ceil($seconds / 60) . ' minutes.';
        $message = 'Please try again in ' . $seconds . ' Or use another number.';

        throw new HttpResponseException(response([
            'errors' => [
                'mobile_number' => [
                    $message
                ],
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
}