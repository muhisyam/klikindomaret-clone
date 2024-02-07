<?php

namespace App\Http\Controllers\App\Auth;

use App\Actions\ClientRequestAction;
use App\Actions\CreateMultipartAction;
use App\DataTransferObjects\ClientRequestDto;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    protected string $endpoint;

    public function __construct(
        protected ClientRequestAction $clientAction,
        protected CreateMultipartAction $multipartAction,
    ) {
        $this->endpoint = env('API_URL') . '/v1/verify-mobile';
    }

    public function __invoke(Request $request) 
    {
        $formData = $this->multipartAction->create($request->all());
        
        $data = $this->clientAction->request(
            new ClientRequestDto(
                method: 'POST',
                endpoint: $this->endpoint,
                formData: $formData,
            )
        );

        dd($data);

        return redirect()->intended('/')->with(['step' => 'verifyOTP']);
    }
}
