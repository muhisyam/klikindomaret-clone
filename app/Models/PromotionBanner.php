<?php

namespace App\Models;

use App\Enums\DeployStatus;
use App\Enums\SelectSpesificRoute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromotionBanner extends Model
{
    use HasFactory;

    protected $guarded = ['product_ids'];
    
    protected $attributes = [
        'promotion_quota' => 0,
        'banner_image_name' => 'banner-default-image.jpg',
        'original_banner_image_name' => 'banner-default-image.jpg',
        'banner_deploy_status' => DeployStatus::DRAFT->value,
        'banner_route_name' => SelectSpesificRoute::PAGE_PROMO->value,
        'banner_start_date' => '2024-01-01 00:00:00',
        'banner_end_date' => '2024-01-01 00:00:00',
        'model_type' => 'banner',
    ];

    protected $casts = [
        'banner_deploy_status' => DeployStatus::class,
        'banner_route_name' => SelectSpesificRoute::class,
    ];

    public function children()
    {
        return $this->hasMany(PromotionBanner::class, 'parent_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)->withTimestamps();
    }
}
