<?php

namespace App\Traits\Auth;

use App\Actions\ErrorTraceAction;
use App\Events\Auth\Lockout;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

trait AuthenticatesUser
{
    protected $request;

    /**
     * Attempt to authenticate the request's credentials.
     */
    public function authenticated(LoginRequest $request): void
    {
        $this->request = $request;
        $this->ensureIsNotRateLimited();

        if (! $this->attemptLogin()) {
            RateLimiter::hit($this->throttleKey());

            $trace = app(ErrorTraceAction::class)->execute();
            $this->sendFailedLoginResponse($trace);
        }

        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Ensure the login request is not rate limited.
     */
    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this->request));

        $trace = app(ErrorTraceAction::class)->execute();
        $this->sendTooManyAttempts($trace);
    }

    /**
     * Send response when Rate Limiter detect too many attempts failed.
     *
     * @throws \Illuminate\Http\Exceptions\HttpResponseException
     */
    protected function sendTooManyAttempts(array $trace): JsonResponse
    {
        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw new HttpResponseException(response([
            'errors' => [
                'mobile_email' => [ 
                    trans('auth.throttle', [
                        'seconds' => $seconds,
                        'minutes' => ceil($seconds / 60)
                    ]),
                ],
            ],
            'meta' => [
                'status_code' => 429,
                'message' => 'Too Many Request',
                'trace' => [
                    'File' => $trace['filename'],
                    'Line' => $trace['line'],
                ],
            ],
        ])->setStatusCode(429));
    }

    /**
     * Send response when authenticate attempt failed.
     *
     * @throws \Illuminate\Http\Exceptions\HttpResponseException
     */
    protected function sendFailedLoginResponse(array $trace): JsonResponse
    {
        throw new HttpResponseException(response([
            'errors' => [
                'mobile_email' => [
                    trans('auth.failed')
                ],
            ],
            'meta' => [
                'status_code' => 401,
                'message' => 'Unauthorized',
                'trace' => [
                    'File' => $trace['filename'],
                    'Line' => $trace['line'],
                ],
            ],
        ])->setStatusCode(401));
    }

    /**
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function attemptLogin(): bool
    {
        return Auth::attempt(
            $this->credentials(),
            $this->request->boolean('remember_me'),
        );
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(): array
    {
        $username = ctype_digit($this->request['mobile_email']) ? 'mobile_number' : 'email';

        return [
            $username => $this->request['mobile_email'],
            'password' => $this->request['password'],
        ];
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->request['mobile_email']) . '|' . $this->request->getClientIp());
    }
}