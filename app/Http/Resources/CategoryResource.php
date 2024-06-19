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
        $includeForm       = isset($this->additional['with_form']);
        $hasParent         = ! is_null($this->whenLoaded('parent'));
        $categoryLevelZero = [
            'id'             => 0,
            'category_name'  => 'Induk Kategori',
            'category_level' => 'Kategori Level 0',
            'parent'         => null,
        ];

        return [
            'parent_id'                    => $this->parent_id,
            'category_name'                => $this->category_name,
            'category_slug'                => $this->category_slug,
            'category_deploy_status'       => $this->category_deploy_status,
            'category_image_name'          => $this->category_image_name,
            'original_category_image_name' => $this->original_category_image_name,
            'model_type'                   => $this->model_type,
            'category_image_size'          => $this->getImageSize() ?? null,
            'category_children_count'      => $this->whenCounted('children'),
            'category_products_count'      => $this->whenCounted('products'),
            'category_parent'              => new CategoryResource($this->whenLoaded('parent')),
            'category_children'            => CategoryResource::collection($this->whenLoaded('children')),
            'form_select_parent'           => $includeForm && $hasParent ? new SelectCategoryMinimalResource($this->whenLoaded('parent')) : $categoryLevelZero,
        ];
    }
}
