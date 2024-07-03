<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductImage extends Model
{
    use HasFactory;

    protected $table = 'product_images';

    protected $fillable = [
        'product_id',
        'product_image_name',
        'original_product_image_name',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getImageSize()
    {
        $imagePath = 'img/uploads/products/'. $this->product->product_slug . '/' . $this->product_image_name;
        
        return File::exists($imagePath) ? round(filesize($imagePath) / 1024) : null;
    }

    public function scopeDeleteImages(Builder $query, Array $formData): mixed
    {
        $whetherImageKeyExists        = isset($formData['delete_product_images']) || isset($formData['product_images']);
        $ifJustKeyDeleteImageIsExsits = isset($formData['delete_product_images']) && ! isset($formData['product_images']);

        if (! $whetherImageKeyExists) {
            return false;
        }

        return $query
            ->when($ifJustKeyDeleteImageIsExsits, fn($query) => $query->whereIn('product_image_name', $formData['delete_product_images']))
            ->delete();
    }
}
