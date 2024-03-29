<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProductRequest extends FormRequest
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
                'category_id' => ['required', 'numeric'],
                'supplier_id' => ['required', 'numeric'],
                'plu' => ['required', 'numeric'],
                'product_name' => ['required', 'max:100'],
                'product_slug' => ['required', 'unique:products', 'max:200'],
                'normal_price' => ['required', 'numeric'],
                'discount_price' => ['nullable', 'numeric'],
                'product_stock' => ['required', 'numeric'],
                'product_status' => ['required', 'in:Publish,Draft'],
                'title_product_description.*' => ['required'],
                'product_description.*' => ['required'],
                'product_images.*' => ['required', 'mimes:jpg,png,jpeg', 'max:512'],
                'store_ids' => ['nullable'],
            ];
        } else if ($this->isMethod('put')) {
            return [
                'category_id' => ['required', 'numeric'],
                'supplier_id' => ['required', 'numeric'],
                'plu' => ['required', 'numeric'],
                'product_name' => ['required', 'max:100'],
                'product_slug' => ['required', 'max:200'],
                'normal_price' => ['required', 'numeric'],
                'discount_price' => ['nullable', 'numeric'],
                'product_stock' => ['required', 'numeric'],
                'product_status' => ['required', 'in:Publish,Draft'],
                'title_product_description.*' => ['required'],
                'product_description.*' => ['required'],
                'product_images.*' => ['mimes:jpg,png,jpeg', 'max:512'],
                'store_ids' => ['nullable'],
                'delete_images.*' => ['nullable'],
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
