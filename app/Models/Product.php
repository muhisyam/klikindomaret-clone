<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'category_id',
        'store_id',
        'product_name',
        'product_slug',
        'normal_price',
        'discount_price',
        'product_status',
        'product_stock',
        'plu',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function descriptions()
    {
        return $this->hasMany(ProductDescription::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
}
