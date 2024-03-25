<?php

namespace App\Http\Requests;

use App\Actions\ErrorTraceAction;
use App\Models\FeaturedSection;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class FeaturedSectionRequest extends FormRequest
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
    public function rules(FeaturedSection $featuredSection): array
    {
        if ($this->isMethod('post')) {
            return [
                'featured_name'         => ['required', 'string', 'max:100'],
                'featured_slug'         => ['required', 'string', 'max:200', 'unique:featured_sections,featured_slug'],
                'featured_redirect_url' => ['required', 'string'],
                'content_types.*'       => ['required', 'string', Rule::in($featuredSection->contentType)],
                'content_ids.*'         => ['required', 'numeric'],
            ];
        }

        if ($this->isMethod('put')) {
            return [
                'featured_name'         => ['required', 'string', 'max:100'],
                'featured_slug'         => ['required', 'string', 'max:200'],
                'featured_redirect_url' => ['required', 'string'],
                'content_types.*'       => ['required', 'string', Rule::in($featuredSection->contentType)],
                'content_ids.*'         => ['required', 'numeric'],
            ];
        }
    }

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
