<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'role_id' => $this->role_id,
            // 'role' => new RoleResource($this->whenLoaded('role')),
            'fullname' => $this->fullname,
            'username' => $this->username,
            'email' => $this->email,
            'email_verified_at' => $this->email_verified_at,
            // 'password' => $this->password,
            'gender' => $this->gender,
            'birthdate' => $this->birthdate,
            'mobile_number' => $this->mobile_number,
            'mobile_number_verified_at' => $this->mobile_number_verified_at,
            'user_image_name' => $this->user_image_name,
            'last_login' => $this->last_login,
        ];
    }
}
