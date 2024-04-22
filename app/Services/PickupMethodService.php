<?php

namespace App\Services;

use App\Models\Retailer;
use App\Models\UserAddress;

class PickupMethodService 
{
    public function getPickupDetailAddress(object $userPickupMethods): object
    {
        $isPickedInStore = false;
        $pickupIcon      = 'shipping';

        foreach ($userPickupMethods as $method) {
            if ($this->isPickedUpInStore($method)) {
                $isPickedInStore = true;
                $pickupIcon      = 'send-by-store';
            }

            $placeDetail          = $this->getPlaceDetailInformation($method, $this->userPlacePickedIn($method));
            $method->place_detail = $placeDetail;
        }

        $userPickupMethods['is_picked_up_in_store'] = $isPickedInStore;
        $userPickupMethods['pickup_icon']           = $pickupIcon;

        return $userPickupMethods;
    }

    private function isPickedUpInStore($method): bool
    {
        return $method->last_pickup_with_retailer ? true : false;
    }

    private function userPlacePickedIn($method): string
    {
        return $this->isPickedUpInStore($method) ? 'store' : 'address';
    }

    private function getPlaceDetailInformation(object $method, string $pickedUpIn): array
    {
        $dataAttributes = $this->getDataAttributes($pickedUpIn);
        $placeId        = $method[$dataAttributes['place_id']];
        $dataplace      = $dataAttributes['model']::find($placeId);
        $detailAttr     = $dataAttributes['detail_attribute'];
        $placeDetail    = [
            'place_name'            => $dataplace[$detailAttr['place_name']],
            'place_address'         => $dataplace[$detailAttr['place_address']],
            'reciever_name'         => $dataplace[$detailAttr['reciever_name']],
            'reciever_phone_number' => $dataplace[$detailAttr['reciever_phone_number']],
        ];

        return $placeDetail;
    }

    private function getDataAttributes(string $pickedUpIn): array
    {
        return match ($pickedUpIn) {
            'store' => [
                'model'            => new Retailer,
                'place_id'         => 'last_pickup_with_retailer',
                'detail_attribute' => [
                    'place_name'            => 'retailer_name',
                    'place_address'         => 'retailer_address',
                    'reciever_name'         => 'retailer_name',
                    'reciever_phone_number' => null,
                ],
            ],
            'address' => [
                'model'            => new UserAddress,
                'place_id'         => 'last_pickup_with_address',
                'detail_attribute' => [
                    'place_name'            => 'address_label',
                    'place_address'         => 'address_main',
                    'reciever_name'         => 'reciever_name',
                    'reciever_phone_number' => 'reciever_phone_number',
                ],
            ],
        };
    }
}