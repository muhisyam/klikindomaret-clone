<?php

namespace App\Http\Resources\Auth;

use App\Services\PickupMethodService;
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
            'user'  => [
                'fullname'        => $this->fullname,
                'username'        => $this->username,
                'email'           => $this->email,
                'mobile_number'   => $this->mobile_number,
                'user_image_name' => $this->user_image_name,
                'role'            => $this->whenLoaded('roleAs', $this->getRole()),
                'retailer'        => $this->whenLoaded('retailer', $this->getRetailer()),
                'pickup_address'  => $this->whenLoaded('pickupMethod', $this->getPickupDetailAddress()),
            ],
        ];
    }

    private function getRole(): array
    {
        return [
            'role_id'          => $this->roleAs->id,
            'role_name'        => $this->roleAs->role_name,
            'has_admin_access' => $this->roleAs->admin_access,
        ];
    }

    private function getRetailer(): array
    {
        if (is_null($this->retailer)) {
            return [];
        }

        return [
            'retailer_id'   => $this->retailer->id,
            'retailer_name' => $this->retailer->retailer_name,
            'supplier'      => [
                'supplier_id'   => $this->retailer->supplier->id,
                'supplier_name' => $this->retailer->supplier->supplier_name
            ],
        ];
    }

    /**
     * Retrieves detailed of selected pickup address information based on the pickup method.
    */
    private function getPickupDetailAddress(): array
    {
        if ($this->pickupMethod->isEmpty()) {
            return [];
        }

        $detailAddress = app(PickupMethodService::class)->getPickupDetailAddress($this->pickupMethod);
        $detailAddress = $detailAddress
            ->filter(function ($address) {
                if (! isset($address->is_selected_method)) {
                    return false;
                }

                return $address->is_selected_method;
            })
            ->first();

        return [
            'place_name'        => $detailAddress['place_detail']['place_name'],
            'place_address'     => $detailAddress['place_detail']['place_address'],
            'place_postal_code' => $detailAddress['place_detail']['place_postal_code'],
        ];
    }
}
