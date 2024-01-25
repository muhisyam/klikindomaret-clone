<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPickupMethod extends Model
{
    use HasFactory;

    protected $table = 'user_pickup_methods';

    protected $fillable = [
        'user_id',
        'last_pickup_with_store',
        'last_pickup_with_address',
    ];
}
