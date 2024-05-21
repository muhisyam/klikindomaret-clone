<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Retailer extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $attributes = [
        'retailer_open' => 'Open',
        'opening_times' => '00:00:00',
        'retailer_open' => '00:00:00',
        'longitude' => 0,
        'latitude' => 0,
    ];

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }
}
