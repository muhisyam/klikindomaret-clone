<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SelectCategoryMinimalResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $categoryLevel = is_null($this->parent_id) 
            ? 'Kategori Level 1' 
            : 'Kategori Level 2';

        return [
            'category_id'    => $this->id,
            'category_name'  => $this->category_name,
            'category_level' => $categoryLevel,
        ];
    }
}
