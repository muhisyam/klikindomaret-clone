<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    const ROLE_GOD   = 'Super Admin';
    const ROLE_SUPER = [
        self::ROLE_GOD,
        'Super Admin Store',
        'Super Admin Warehouse',
    ];

    protected $table = 'roles';

    protected $fillable = [
        'role_name',
        'admin_access',
    ];
}
