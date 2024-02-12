<?php

namespace App\Http\Controllers\App\Auth;

use App\Actions\ClientRequestAction;
use App\Actions\CreateMultipartAction;
use App\DataTransferObjects\ClientRequestDto;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VerifyMobileController extends Controller
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

        if ($data['meta']['status_code'] !== 200) {
            return redirect()
                ->back()
                ->with([
                    'input_error' => $data
                ]);
        }

        session([
            'mobile_number' => $request->mobile_number,
            'otp' => $data['otp'],
        ]);

        return redirect()->back()->with('step', $data['step']);
    }

    public function store(Request $request)
    {
        $request['otp_confirmation'] = (int) implode('', array(...$request->otp_confirmation));
        $formData = $this->multipartAction->create($request->all());
        
        $data = $this->clientAction->request(
            new ClientRequestDto(
                method: 'POST',
                endpoint: $this->endpoint,
                formData: $formData,
            )
        );

        if ($data['meta']['status_code'] !== 202) {
            return redirect()
                ->back()
                ->with([
                    'input_error' => $data
                ]);
        }

        session()->forget('otp');
        
        return redirect()->intended('/')->with('step', $data['step']);

    }
}
