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

        session([
            'mobile_number' => $request->mobile_number,
            'otp' => $data['otp'],
            'step' => 'verify',
        ]);

        return redirect()->intended('/');
    }

    public function store(Request $request)
    {
        $inputOtp = (int) implode('', array(...$request->otp));
       
        if ($inputOtp !== session('otp')) {
            return redirect()->intended('/')->with(['verify_wrong' => 'Kode yang dimasukkan salah.']);
        }

        session()->forget('otp');
        session(['step' => 'complete_register']);
        
        return redirect()->intended('/');

    }
}
