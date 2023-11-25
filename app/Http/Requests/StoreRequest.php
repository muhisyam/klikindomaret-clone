<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreRequest extends FormRequest
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
        if ($this->isMethod('post')) {
            return [
                'flag' => ['required', 'max:20'],
                'store_code' => ['max:5', 'unique:stores'],
                'store_name' => ['required', 'max:200'],
            ];
        } else if ($this->isMethod('put')) {
            return [
                'flag' => ['required', 'max:20'],
                'store_code' => ['max:5'],
                'store_name' => ['required', 'max:200'],
            ];
        }
    }
    
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response([
            "errors" => $validator->getMessageBag()
        ], 400));
    }
}
