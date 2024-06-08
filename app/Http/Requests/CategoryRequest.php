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
     * The validator instance.
     *
     * @var \Illuminate\Contracts\Validation\Validator
     */
    protected $validator;

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
            'category_image_name'    => ['image', 'max:512', 'mimes:jpg,png,jpeg,webp'],
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
        $this->validator = $validator;

        // Using not operation, so it can work in livewire urls as well. When fail 
        // validation occurs in livewire, it will return the error json response.
        return ! str_contains(url()->current(), 'api') 
            ? $this->failedValidationInWeb()
            : $this->failedValidationInApi();
    }

    private function failedValidationInApi()
    {
        $trace = app(ErrorTraceAction::class)->execute();
        
        throw new HttpResponseException(response([
            'errors' => $this->validator->getMessageBag(),
            'meta'   => [
                'status_code' => 422,
                'message'     => 'Unprocessable Content',
                'trace'       => [
                    'File' => $trace['filename'],
                    'Line' => $trace['line'],
                ],
            ],
        ], 422));
    }

    private function failedValidationInWeb()
    {
        return back()
            // Why using with not withError, to ensure consistency with the error 
            // format used in API, thereby simplifying the management of input error 
            // components.
            ->with([
                'input_error' => [
                    'errors' => $this->validator->getMessageBag()->getMessages(),
                ]
            ])
            ->withInput()
            ->setStatusCode(422, 'Unprocessable Content');
    }
}
