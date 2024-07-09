<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SearchFilterCategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $keywordName    = $this->whenLoaded('keywords', $this->keywords[0]->keyword_name, '');
        $highlightedKey = highlightString($request->key, $keywordName);

        return [
            'highlighted'   => $highlightedKey,
            'keyword_name'  => $keywordName,
            'category_name' => $this->category_name,
            'category_slug' => $this->category_slug,
        ];
    }
}
