<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guarded = [];

    /**
     * The model's default values for attributes.
     *
     * @var array<string, string>
     */
    protected $attributes = [
        'role_id' => 1,
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Enum value of user gender.
     *
     * @var array<string, string>
     */
    public static $gender = [
        'men'   => 'laki-laki',
        'women' => 'peremnpuan',
    ];

    /**
     * Override the route key use other database column for the model class.
     */
    public function getRouteKeyName(): string
    {
        return 'username';
    }

    // All relations of user model.

    public function roleAs(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function carts(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'carts')
            ->withPivot('quantity')
            ->withTimestamps();
    }

    public function pickupMethod(): HasMany
    {
        return $this->hasMany(UserPickupMethod::class)->orderBy('updated_at', 'desc');;
    }

    public function retailer(): HasOne
    {
        return $this->hasOne(Retailer::class);
    }
}
