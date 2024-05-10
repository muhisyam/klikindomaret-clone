<?php

namespace App\Http\Controllers\App\Auth;

use App\Actions\ClientRequestAction;
use App\DataTransferObjects\ClientRequestDto;
use App\Events\Auth\Authenticated;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    protected string $endpoint;

    public function __construct(
        protected ClientRequestAction $clientAction,
    ) {
        $this->endpoint = config('api.url') . 'login';
    }

    public function login(Request $request) 
    {
        $header = [
            'User-Agent' => $request->userAgent(),
            'X-Original-Ip' => $request->ip(),
        ];
        
        $response = $this->clientAction->request(
            new ClientRequestDto(
                method: 'POST',
                endpoint: $this->endpoint,
                headers: $header,
                formData: $request->all(),
            )
        );

        if ($response['meta']['status_code'] !== 200) {
            return redirect()
                ->back()
                ->with('input_error', array_merge(['form_error' => 'login'], $response))
                ->withInput();
        }

        event(new Authenticated($response));

        return redirect()->intended(RouteServiceProvider::ADMIN);
    }
}
