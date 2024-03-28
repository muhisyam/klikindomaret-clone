<?php

namespace App\Models;

use App\Enums\DeployStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $attributes = [
        'normal_price' => 0,
        'product_stock' => 0,
        'product_deploy_status' => DeployStatus::DRAFT->value,
        'model_type' => 'product',
    ];

    protected $casts = [
        'product_deploy_status' => DeployStatus::class,
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function descriptions()
    {
        return $this->hasMany(ProductDescription::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function retailers()
    {
        return $this->belongsToMany(Retailer::class)->withTimestamps();
    }

    public function getStoreIds(mixed $storeCollection)
    {
        if (!$storeCollection instanceof \Illuminate\Http\Resources\MissingValue) {
            return $storeCollection->pluck('id')->toArray();
        }
        
        return null;
    }

    public function scopeSearch($query, $keyword)
    {
        return $query->where('product_name', 'like', '%' . $keyword . '%');
    }

    public function scopeGetKeywordList($query): string
    {
        $productKeyword = $query->pluck('product_meta_keyword')->implode(',');
        $arrProductKeyword = explode(',', str_replace(' ', '', $productKeyword));
        
        return implode(',', array_unique($arrProductKeyword));
    }
}
