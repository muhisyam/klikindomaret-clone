<?php

namespace App\Traits;

use App\Actions\ErrorTraceAction;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Exceptions\HttpResponseException;

trait AuthenticatesUser
{
    public function __construct(
        protected LoginRequest $request,
        protected ErrorTraceAction $trace,
    ){} 

    public function authenticated()
    {
        if (! $this->attemptLogin($this->request)) {
            $this->sendFailedLoginResponse(
                $this->trace->execute()
            );
        }

        // TODO: ADD RATE LIMITER
    }

    protected function sendFailedLoginResponse(array $trace)
    {
        throw new HttpResponseException(response([
            'status_code' => 400,
            'message' => 'Bad Request',
            'errors' => [
                'phone_email' => trans('auth.failed'),
            ],
            "trace" => [
                'File' => $trace['filename'],
                'Line' => $trace['line'],
            ]
        ], 400));
    }

    protected function attemptLogin()
    {
        return Auth::attempt(
            $this->credentials($this->request),
            $this->request->boolean('remember_me'),
        );
    }

    protected function credentials()
    {
        $username = ctype_digit($this->request['phone_email']) ? 'phone_number' : 'email';

        return [
            $username => $this->request['phone_email'],
            'password' => $this->request['password'],
        ];
    }

}