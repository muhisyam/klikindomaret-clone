<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderRelationshipUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'fullname'      => $this->fullname,
            'username'      => $this->username,
            'email'         => $this->email ?? '-',
            'mobile_number' => $this->mobile_number ?? '-',
        ];
    }
}
