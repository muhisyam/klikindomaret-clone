<?php

namespace App\Models;

use App\Enums\SelectSpesificRoute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfficialStore extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $attributes = [
        'store_image_name' => 'store-default-image.jpg',
        'original_store_image_name' => 'store-default-image.jpg',
        'store_route_name' => SelectSpesificRoute::PAGE_STORE->value,
        'featured_store' => 0,
        'model_type' => 'official-store',
    ];

    protected $casts = [
        'store_route_name' => SelectSpesificRoute::class,
    ];

    public function brands()
    {
        return $this->hasMany(Brand::class);
    }
}
