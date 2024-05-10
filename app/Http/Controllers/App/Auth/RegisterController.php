<?php

namespace App\Http\Controllers\App\Auth;

use App\Actions\ClientRequestAction;
use App\DataTransferObjects\ClientRequestDto;
use App\Events\Auth\Authenticated;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    protected string $endpoint;

    public function __construct(
        protected ClientRequestAction $clientAction,
    ) {
        $this->endpoint = config('api.url') . 'register';
    }

    public function register(Request $request)
    {
        $response = $this->clientAction->request(
            new ClientRequestDto(
                method: 'POST',
                endpoint: $this->endpoint,
                formData: $request->all(),
            )
        );

        if ($response['meta']['status_code'] !== 200) {
            return redirect()
                ->back()
                ->with([
                    'step' => 'Complete Registration', 
                    'input_error' => array_merge(['form_error' => 'register'], $response),
                ])
                ->withInput();
        }

        event(new Authenticated($response));

        return redirect(RouteServiceProvider::HOME);
    }
}
