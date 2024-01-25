<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['role_name' => 'User', 'admin_access' => 0, 'created_at' => now()],
            ['role_name' => 'Member', 'admin_access' => 0, 'created_at' => now()],
            ['role_name' => 'Super Admin', 'admin_access' => 1, 'created_at' => now()],
            ['role_name' => 'Admin Store', 'admin_access' => 1, 'created_at' => now()],
            ['role_name' => 'Admin Warehouse', 'admin_access' => 1, 'created_at' => now()],
        ];

        Role::insert($data);
    }
}
