<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeaturedSection extends Model
{
    protected $fillable = [
        'featured_name',
        'featured_slug',
        'featured_redirect_url',
    ];

    public $contentType = [
        'Produk',
        'Promosi',
    ];

    public function products()
    {
        return $this->morphedByMany(Product::class, 'featured_section_content')->withTimestamps();
    }

    public function promos()
    {
        return $this->morphedByMany(PromotionBanner::class, 'featured_section_content')->withTimestamps();
    }

    public function morphContentTo(string $contentType)
    {
        return match ($contentType) {
            'Produk' => $this->products(),
            'Promosi' => $this->promos(),
        };
    }

    public function detachMorphContent()
    {
        $this->products()->detach();
        $this->promos()->detach();
    }
}
