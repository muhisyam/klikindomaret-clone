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
        $this->endpoint = env('API_URL') . '/v1/register';
    }

    public function register(Request $request)
    {
        $formData = $this->multipartAction->create($request->all());
        
        $data = $this->clientAction->request(
            new ClientRequestDto(
                method: 'POST',
                endpoint: $this->endpoint,
                formData: $formData,
            )
        );

        if ($data['meta']['status_code'] === 400) {
            return redirect()
                ->back()
                ->with([
                    'step' => 'complete_register', 
                    'inputError' => $data,
                ])
                ->withInput();
        }

        // TODO: move to authenticate event
        $request->session()->regenerate();

        session([
            'auth_token' => $data['data']['token'],
            'fullname' => $data['data']['user']['fullname'],
            'username' => $data['data']['user']['username'],
        ]);

        return redirect(RouteServiceProvider::HOME);
    }
}
