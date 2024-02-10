<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthenticateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'token' => $this->token,
            'user' => new UserResource($this),
        ];
    }
    
    public function with(Request $request): array
    {
        return [
            'meta' => [
                'status_code' => 200,
                'message' => 'Success',
            ],
        ];
    }
}
