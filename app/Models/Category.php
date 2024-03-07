<?php

namespace App\Models;

use App\Enums\DeployStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $attributes = [
        'category_deploy_status' => DeployStatus::DRAFT->value,
        'model_type' => 'category',
    ];

    protected $casts = [
        'category_deploy_status' => DeployStatus::class,
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
