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
        return [
            'id'             => $this->id,
            'category_name'  => $this->category_name,
            'category_level' => $this->getLevel(),
            'parent'         => $this->getParentResource(),
        ];
    }

    private function getLevel()
    {
        if (isset($this->parent->parent)) {
            return 'Kategori level 3';
        } elseif (isset($this->parent)) {
            return 'Kategori level 2';
        } else {
            return 'Kategori level 1';
        }
    }

    private function getParentResource()
    {
        if (is_null($this->parent)) { 
            return null; 
        }

        if (is_null($this->parent->parent)) {
            return [
                'parent_lvl_1' => $this->parent->category_name,
            ];
        }

        return [
            'parent_lvl_1' => $this->parent->parent->category_name,
            'parent_lvl_2' => ' / ' . $this->parent->category_name,
        ];
    }
}
