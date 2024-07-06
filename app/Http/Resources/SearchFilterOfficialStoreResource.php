<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SearchFilterOfficialStoreResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'store_name'         => $this->store_name,
            'store_slug'         => $this->store_slug,
            'store_route_name'   => $this->store_route_name,
            'store_redirect_url' => $this->store_redirect_url,
            'store_image_name'   => $this->store_image_name,
        ];
    }
}
