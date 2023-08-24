<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CategoryRequest extends FormRequest
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
                'parent_id' => ['required', 'numeric'],
                'name' => ['required', 'max:100'],
                'slug' => ['required', 'unique:categories', 'max:200'],
                'status' => ['required'],
            ];
        }

        if ($this->isMethod('put')) {
            return [
                'parent_id' => ['required', 'numeric'],
                'name' => ['required', 'max:100'],
                'slug' => ['required', 'max:200'],
                'status' => ['required'],
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
