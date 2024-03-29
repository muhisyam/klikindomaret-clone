<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ModalPromoListResource extends JsonResource
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
            'banner_name' => $this->banner_name,
            'banner_image_name' => $this->banner_image_name,
            'banner_start_date' => Carbon::parse($this->banner_start_date)->format('M d, Y'),
            'banner_end_date' => Carbon::parse($this->banner_end_date)->format('M d, Y'),
            'model_type' => $this->model_type,
        ];
    }
}
