<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'fullname',
        'username',
        'email',
        'password',
        'gender',
        'birthdate',
        'mobile_number',
        'last_login',
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'mobile_number_verified_at' => 'datetime',
    ];

    public function roleAs()
    {
        return $this->belongsTo(Role::class);
    }

    public function carts(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'carts')->withPivot('quantity')->withTimestamps();
    }

    public function pickupMethod(): HasMany
    {
        return $this->hasMany(UserPickupMethod::class);
    }
}
