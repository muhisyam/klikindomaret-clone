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
            'id' => $this->id,
            'parent_id' => $this->parent_id,
            'parent' => new CategoryResource($this->whenLoaded('parent')),
            'category_name' => $this->category_name,
            'category_slug' => $this->category_slug,
            'category_status' => $this->category_status,
            'category_image_name' => $this->category_image_name,
            'original_category_image_name' => $this->original_category_image_name,
            'children_count' => $this->children_count,
            'children' => CategoryResource::collection($this->whenLoaded('children')),
        ];
    }
}
