<?php

namespace App\Http\Requests;

use App\Actions\ErrorTraceAction;
use App\Enums\DeployStatus;
use App\Enums\SelectSpesificRoute;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class PromotionBannerRequest extends FormRequest
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
        return [
            'parent_id' => ['nullable', 'numeric'],
            'banner_name' => ['required', 'string', 'max:100'],
            'banner_slug' => ['required', 'string', 'unique:promotion_banners', 'max:200'],
            'promotion_code' => ['nullable', 'string', 'unique:promotion_banners', 'max:15'],
            'promotion_quota' => ['required_with:promotion_code', 'numeric'],
            'short_term_condition' => ['nullable', 'string', 'max:100'],
            'term_condition' => ['nullable', 'string'],
            'banner_image_name' => ['required', 'image', 'mimes:jpg,png,jpeg,webp', 'max:512'],
            'banner_deploy_status' => [Rule::in(DeployStatus::class)],
            'banner_route_name' => [Rule::in(SelectSpesificRoute::class)],
            'banner_redirect_url' => ['nullable', 'string', 'max:200'],
            'banner_start_date' => ['date'],
            'banner_end_date' => ['date'],
            'banner_meta_keyword' => ['string'],
            'product_ids' => ['required'],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $trace = app(ErrorTraceAction::class)->execute();
        
        throw new HttpResponseException(response([
            'errors' => $validator->getMessageBag(),
            'meta' => [
                'status_code' => 400,
                'message' => 'Bad Request',
                'trace' => [
                    'File' => $trace['filename'],
                    'Line' => $trace['line'],
                ],
            ],
        ], 400));
    }
}
