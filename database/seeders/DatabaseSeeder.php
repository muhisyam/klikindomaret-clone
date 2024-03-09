<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CategorySeeder::class,
            OfficialStoreSeeder::class,
            BrandSeeder::class,
            RegionSeeder::class,
            SupplierSeeder::class,
            RetailerSeeder::class,
            ProductSeeder::class,
            RoleSeeder::class,
        ]);
    }
}
