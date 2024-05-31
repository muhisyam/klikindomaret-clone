<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'category_name'                => $this->category_name,
            'category_slug'                => $this->category_slug,
            'category_deploy_status'       => $this->category_deploy_status,
            'category_image_name'          => $this->category_image_name,
            'original_category_image_name' => $this->original_category_image_name,
            'model_type'                   => $this->model_type,
            'category_children_count'      => $this->whenCounted('children'),
            'category_parent'              => new CategoryResource($this->whenLoaded('parent')),
            'category_children'            => CategoryResource::collection($this->whenLoaded('children')),
        ];
    }
}
