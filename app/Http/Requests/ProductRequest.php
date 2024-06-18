<?php

namespace App\Http\Requests;

use App\Actions\ErrorTraceAction;
use App\Enums\DeployStatus;
use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Factory;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{
    /**
     * Create new custom rule request.
     * 
     * @param  \Illuminate\Contracts\Validation\Factory  $validationFactory
     */
    public function __construct(Factory $validationFactory)
    {
        $validationFactory->extend(
            'must_have_images',
            function ($attribute, $value, $parameters) {
                if (isset($this->product_images)) {
                    return true;
                }

                $productImageCount = Product::getImageCount($this->route('product'));
                $deleteImageCount  = count($this->delete_product_images);
                
                return $deleteImageCount != $productImageCount;
            },
            'The product field must have an image.'
        );

    }

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
            'category_id'           => ['required', 'numeric', 'exists:categories,id', ],
            'brand_id'              => ['required', 'numeric', 'exists:brands,id'],
            'supplier_id'           => ['required', 'numeric', 'exists:suppliers,id'],
            'retailers_id'          => ['required'],
            'plu'                   => ['required', 'numeric'],
            'product_name'          => ['required', 'string', 'max:100'],
            'product_slug'          => ['required', 'string', 'max:200'],
            'normal_price'          => ['required', 'numeric'],
            'discount_price'        => ['nullable', 'numeric'],
            'discount_start_date'   => ['nullable', 'date', 'before:discount_end_date'],
            'discount_end_date'     => ['nullable', 'date', 'after:discount_start_date'],
            'product_stock'         => ['required', 'numeric', 'gt:0'],
            'product_deploy_status' => ['required', Rule::enum(DeployStatus::class)],
            'product_description'   => ['required'],
            'product_meta_keyword'  => ['required'],
            'product_images.*'      => ['image', 'mimes:jpg,png,jpeg,webp', 'max:512'],
        ];

        switch ($this->method()) {
            case 'POST':
                $rules['product_images.*'] = array_merge($rules['product_images.*'], ['required']);
                $rules['product_slug']     = array_merge($rules['product_slug'], ['unique:products,product_slug']);
                break;
            
            case 'PUT':
                $rules = array_merge($rules, ['delete_product_images.*' => ['nullable', 'must_have_images']]);
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
            // Why using "with" not "withError", to ensure consistency with the error 
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
