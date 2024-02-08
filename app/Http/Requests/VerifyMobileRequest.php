<?php

namespace App\Http\Requests;

use App\Actions\ErrorTraceAction;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class VerifyMobileRequest extends FormRequest
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
            'mobile_number' => ['required', 'numeric', 'digits_between:10,13'],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $trace = app(ErrorTraceAction::class)->execute();
        
        throw new HttpResponseException(response([
            'status_code' => 400,
            'message' => 'Bad Request',
            "errors" => $validator->getMessageBag(),
            "trace" => [
                'File' => $trace['filename'],
                'Line' => $trace['line'],
            ]
        ], 400));
    }
}