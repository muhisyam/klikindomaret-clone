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
        'deploy_status' => DeployStatus::DRAFT->value,
        'route_name' => SelectSpesificRoute::PAGE_PROMO->value,
        'model_type' => 'banner',
    ];

    protected $casts = [
        'deploy_status' => DeployStatus::class,
        'route_name' => SelectSpesificRoute::class,
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
