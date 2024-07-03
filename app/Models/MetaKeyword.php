<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class MetaKeyword extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function brands(): MorphToMany
    {
        return $this->morphedByMany(Brand::class, 'meta_keyword_content')
            ->withPivot('weight')
            ->withTimestamps();
    }

    public function categories(): MorphToMany
    {
        return $this->morphedByMany(Category::class, 'meta_keyword_content')
            ->withPivot('weight')
            ->withTimestamps();
    }

    public function promos(): MorphToMany
    {
        return $this->morphedByMany(PromotionBanner::class, 'meta_keyword_content')
            ->withPivot('weight')
            ->withTimestamps();
    }

    public function products(): MorphToMany
    {
        return $this->morphedByMany(Product::class, 'meta_keyword_content')
            ->withPivot('weight')
            ->withTimestamps();
    }
}
