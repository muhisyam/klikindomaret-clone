<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [];

    public static array $staticStoreSupplier = [
        1,
        2,
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array<string, string>
     */
    protected $attributes = [
        'is_official_store' => false,
    ];

    public function retailers(): HasMany
    {
        return $this->hasMany(Retailer::class);
    }

    public function scopeGetStoreSupplier($query, string $column, string $key = null): object
    {
        return $query->where('is_official_store', true)->pluck($column, $key);
    }
}
