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
            'name' => $this->name,
            'slug' => $this->slug,
            'status' => $this->status,
            'image' => $this->image,
            'original_image_name' => $this->original_image_name,
            'children_count' => $this->children_count,
            'children' => CategoryResource::collection($this->whenLoaded('children')),
        ];
    }
}
