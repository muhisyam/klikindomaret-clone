<?php

namespace App\Traits;

use App\Actions\ErrorTraceAction;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

trait AuthenticatesUser
{
    protected $request;

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticated(LoginRequest $request)
    {
        $this->request = $request;

        if (! $this->attemptLogin($request)) {
            $trace = app(ErrorTraceAction::class)->execute();

            $this->sendFailedLoginResponse($trace);
        }

        // TODO: ADD RATE LIMITER
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
                'phone_email' => trans('auth.failed'),
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
            $this->credentials($this->request),
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
        $username = ctype_digit($this->request['phone_email']) ? 'phone_number' : 'email';

        return [
            $username => $this->request['phone_email'],
            'password' => $this->request['password'],
        ];
    }

}