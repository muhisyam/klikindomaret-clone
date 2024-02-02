<?php

namespace App\Http\Controllers\App\Auth;

use App\Actions\ClientRequestAction;
use App\Actions\CreateMultipartAction;
use App\DataTransferObjects\ClientRequestDto;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    protected string $endpoint;

    public function __construct(
        protected ClientRequestAction $clientAction,
        protected CreateMultipartAction $multipartAction,
    ) {
        $this->endpoint = env('API_URL') . '/v1/login';
    }

    public function login(Request $request) 
    {
        $formData = $this->multipartAction->create($request->all());
        
        $data = $this->clientAction->request(
            new ClientRequestDto(
                method: 'POST',
                endpoint: $this->endpoint,
                formData: $formData,
            )
        );

        if (isset($data['errors'])) {
            return redirect()->route('auth.fail');
        }

        $this->authenticated($request, $data);

        return redirect()->intended('/');
    }

    public function authenticated(Request $request, array $dataAuth)
    {
        $request->session()->regenerate();

        session([
            'auth_token' => $dataAuth['data']['token'],
            'username' => $dataAuth['data']['user']['username'],
        ]);
    }
}
