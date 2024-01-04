<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegionRequest extends FormRequest
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
                'region_code' => ['required', 'max:5', 'unique:regions'],
                'region_name' => ['required', 'max:200'],
                'region_postal_code' => ['required', 'numeric'],
            ];
        } else if ($this->isMethod('put')) {
            return [
                'region_code' => ['required', 'max:5'],
                'region_name' => ['required', 'max:200'],
                'region_postal_code' => ['required', 'numeric'],
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
