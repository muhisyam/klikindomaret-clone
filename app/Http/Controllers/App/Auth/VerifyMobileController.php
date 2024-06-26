<?php

namespace App\Http\Controllers\App\Auth;

use App\Actions\ClientRequestAction;
use App\DataTransferObjects\ClientRequestDto;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VerifyMobileController extends Controller
{
    protected string $endpoint;

    public function __construct(
        protected ClientRequestAction $clientAction,
    ) {
        $this->endpoint = config('api.url');
    }

    public function __invoke(Request $request) 
    {
        $response = $this->clientAction->request(
            new ClientRequestDto(
                method: 'POST',
                endpoint: $this->endpoint . 'verify-mobile',
                formData: $request->all(),
            )
        );

        if ($response['meta']['status_code'] !== 200) {
            return redirect()
                ->back()
                ->with([
                    'step' => 'Verify Mobile', 
                    'input_error' => array_merge(['form_error' => 'register'], $response),
                ]);
        }

        session([
            'mobile_number' => $request->mobile_number,
            'otp' => $response['data']['otp'],
            'via' => $response['data']['via'],
        ]);

        return redirect()->back()->with('step', $response['data']['step']);
    }

    public function store(Request $request)
    {
        $request['otp_confirmation'] = (int) implode('', array(...$request->otp_confirmation));
        
        $response = $this->clientAction->request(
            new ClientRequestDto(
                method: 'POST',
                endpoint: $this->endpoint . 'verify-otp',
                formData: $request->all(),
            )
        );

        if ($response['meta']['status_code'] !== 202) {
            return redirect()
                ->back()
                ->with([
                    'step' => 'Verify OTP', 
                    'input_error' => array_merge(['form_error' => 'register'], $response),
                ]);
        }

        session()->forget('otp');
        
        return redirect()->intended('/')->with('step', $response['data']['step']);

    }
}
