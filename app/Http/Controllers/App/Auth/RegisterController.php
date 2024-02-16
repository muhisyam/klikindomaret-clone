<?php

namespace App\Http\Controllers\App\Auth;

use App\Actions\ClientRequestAction;
use App\Actions\CreateMultipartAction;
use App\DataTransferObjects\ClientRequestDto;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    protected string $endpoint;

    public function __construct(
        protected ClientRequestAction $clientAction,
        protected CreateMultipartAction $multipartAction,
    ) {
        $this->endpoint = config('api.url') . 'register';
    }

    public function register(Request $request)
    {
        $formData = $this->multipartAction->create($request->all());
        
        $response = $this->clientAction->request(
            new ClientRequestDto(
                method: 'POST',
                endpoint: $this->endpoint,
                formData: $formData,
            )
        );

        if ($response['meta']['status_code'] === 400) {
            return redirect()
                ->back()
                ->with([
                    'step' => 'Complete Registration', 
                    'input_error' => $response,
                ])
                ->withInput();
        }

        // TODO: move to authenticate event
        $request->session()->regenerate();

        session([
            'auth_token' => $response['data']['token'],
            'fullname' => $response['data']['user']['fullname'],
            'username' => $response['data']['user']['username'],
        ]);

        return redirect(RouteServiceProvider::HOME);
    }
}
