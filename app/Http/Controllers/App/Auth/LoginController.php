<?php

namespace App\Http\Controllers\App\Auth;

use App\Actions\ClientRequestAction;
use App\Actions\CreateMultipartAction;
use App\DataTransferObjects\ClientRequestDto;
use App\Events\Authenticated;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    protected string $endpoint;

    public function __construct(
        protected ClientRequestAction $clientAction,
        protected CreateMultipartAction $multipartAction,
    ) {
        $this->endpoint = config('api.url') . 'login';
    }

    public function login(Request $request) 
    {
        $formData = $this->multipartAction->create($request->all());
        $header = [
            'User-Agent' => $request->userAgent(),
            'X-Original-Ip' => $request->ip(),
        ];
        
        $response = $this->clientAction->request(
            new ClientRequestDto(
                method: 'POST',
                endpoint: $this->endpoint,
                headers: $header,
                formData: $formData,
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
