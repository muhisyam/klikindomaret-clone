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
                'region_id' => ['required', 'numeric'],
                'supplier_id' => ['required', 'numeric'],
                'store_code' => ['required', 'max:5', 'unique:stores'],
                'store_name' => ['required', 'max:200'],
                'store_address' => ['required', 'max:200'],
                'store_open' => ['required', 'in:Open,Close'],
                'opening_times' => ['required'],
                'closing_times' => ['required'],
                'longitude' => ['required', 'numeric'],
                'latitude' => ['required', 'numeric'],
            ];
        } else if ($this->isMethod('put')) {
            return [
                'region_id' => ['required', 'numeric'],
                'supplier_id' => ['required', 'numeric'],
                'store_code' => ['required', 'max:5'],
                'store_name' => ['required', 'max:200'],
                'store_address' => ['required', 'max:200'],
                'store_open' => ['required', 'in:Open,Close'],
                'opening_times' => ['required'],
                'closing_times' => ['required'],
                'longitude' => ['required', 'numeric'],
                'latitude' => ['required', 'numeric'],
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
