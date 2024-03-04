<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeaturedContent extends Model
{
    use HasFactory;

    protected $table = 'featured_contents';

    protected $fillable = [
        'featured_name',
        'featured_slug',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class)->withTimestamps();
    }

    public function getProductIds(mixed $productCollection)
    {
        if (!$productCollection instanceof \Illuminate\Http\Resources\MissingValue) {
            return $productCollection->pluck('id')->toArray();
        }
        
        return null;
    }
}