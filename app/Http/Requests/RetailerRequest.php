<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class RetailerRequest extends FormRequest
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
        $rules = [
            'region_id'        => ['required', 'numeric'],
            'supplier_id'      => ['required', 'numeric'],
            'retailer_code'    => ['required', 'max:5'],
            'retailer_name'    => ['required', 'max:200'],
            'retailer_address' => ['required', 'max:200'],
            'retailer_open'    => ['required', 'in:Open,Close'],
            'opening_times'    => ['required'],
            'closing_times'    => ['required'],
            'longitude'        => ['required', 'numeric'],
            'latitude'         => ['required', 'numeric'],
        ];

        if ($this->isMethod('post')) {
            $rules['retailer_code'] = array_merge($rules['retailer_code'], ['unique:retailers,retailer_code']);
        }

        return $rules;
    }
    
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response([
            "errors" => $validator->getMessageBag()
        ], 400));
    }
}
