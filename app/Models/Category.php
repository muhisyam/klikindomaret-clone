<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = [
        'parent_id',
        'category_name',
        'category_slug',
        'category_status',
        'category_image_name',
        'original_category_image_name',
    ];
    
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function setParentId(string $inputId)
    {
        return $inputId !== '0' ? $inputId : null;
    }

    public function setImageValue(array $formData)
    {
        if (isset($formData['delete_image'])) {
            return null;
        } elseif (isset($formData['category_image'])) {
            return $formData['category_image'];
        }
    }
}
