<?php

namespace App\Http\Requests\Auth;

use App\Actions\ErrorTraceAction;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class VerifyOtpRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'mobile_number' => ['required'],
            'otp' => ['required'],
            'otp_confirmation' => ['required', 'same:otp'],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $trace = app(ErrorTraceAction::class)->execute();
        
        throw new HttpResponseException(response([
            'errors' => [
                'incorrect_otp' => ['Incorrect OTP entered. Please try again.'],
            ],
            'meta' => [
                'status_code' => 401,
                'message' => 'Unauthorized',
                'trace' => [
                    'File' => $trace['filename'],
                    'Line' => $trace['line'],
                ],
            ],
        ], 401));
    }
}
