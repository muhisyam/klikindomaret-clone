<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class SupplierRequest extends FormRequest
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
                'flag_code' => ['required', 'max:2', 'unique:suppliers'],
                'flag_name' => ['required', 'max:20', 'unique:suppliers'],
                'supplier_name' => ['required', 'max:200'],
            ];
        } else if ($this->isMethod('put')) {
            return [
                'flag_code' => ['required', 'max:2'],
                'flag_name' => ['required', 'max:20'],
                'supplier_name' => ['required', 'max:200'],
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
