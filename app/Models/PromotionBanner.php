<?php

namespace App\Models;

use App\Enums\DeployStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromotionBanner extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    protected $attributes = [
        'deploy_status' => DeployStatus::class,
        'route_name' => 'page.promo',
        'model_type' => 'banner',
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
