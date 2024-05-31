<?php

namespace App\Http\Requests;

use App\Actions\ErrorTraceAction;
use App\Enums\DeployStatus;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

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
        $rules = [
            'parent_id'              => ['required', 'numeric'],
            'category_name'          => ['required', 'string', 'max:100'],
            'category_slug'          => ['required', 'string', 'max:200'],
            'category_deploy_status' => ['required', Rule::enum(DeployStatus::class)],
            'category_image_name'    => ['image', 'mimes:jpg,png,jpeg', 'max:512'],
        ];

        switch ($this->method()) {
            case 'POST':
                $rules['category_slug'] = array_merge($rules['category_slug'], ['unique:categories,category_slug']);
                break;
            
            case 'PUT':
                $rules = array_merge($rules, ['delete_category_image' => ['nullable']]);
                break;
        }

        return $rules;
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param  Validator $validator
     * @return void
     *
     * @throws HttpResponseException
     */
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
