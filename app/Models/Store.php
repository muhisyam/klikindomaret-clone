<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $table = 'stores';

    protected $fillable = [
        'region_id',
        'supplier_id',
        'store_code',
        'store_name',
        'store_address',
        'store_open',
        'opening_times',
        'closing_times',
        'longitude',
        'latitude',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
