<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $attributes = [
        'model_type' => 'brand',
    ];

    public function officialStore()
    {
        return $this->belongsTo(OfficialStore::class);
    }
}
