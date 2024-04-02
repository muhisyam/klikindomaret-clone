<?php

namespace App\Http\Requests;

use App\Actions\ErrorTraceAction;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CartRequest extends FormRequest
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
            'product_slug' => ['required', 'string', 'exists:products,product_slug'],
            'quantity'     => ['required', 'numeric', 'min:1'],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $trace = app(ErrorTraceAction::class)->execute();
        
        throw new HttpResponseException(response([
            'errors' => $validator->getMessageBag(),
            'meta'   => [
                'status_code' => 400,
                'message'     => 'Bad Request',
                'trace'       => [
                    'File' => $trace['filename'],
                    'Line' => $trace['line'],
                ],
            ],
        ], 400));
    }
}
