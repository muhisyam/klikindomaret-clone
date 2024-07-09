<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SearchFilterKeywordResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $highlightedKey = highlightString($request->key, $this->keyword_name);

        return [
            'highlighted'  => $highlightedKey,
            'keyword_name' => $this->keyword_name,
        ];
    }
}
