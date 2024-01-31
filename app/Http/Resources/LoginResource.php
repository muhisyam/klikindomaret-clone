<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LoginResource extends JsonResource
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
            // TODO: move to user resource
            'user' => [
                'id' => $this->id,
                'username' => $this->username,
                'email' => $this->email,
                'phone_number' => $this->phone_number,
            ],
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
