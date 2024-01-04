<?php

namespace Database\Seeders;

use App\Models\Region;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['region_code' => 'ygya', 'region_name' => 'DI Yogyakarta', 'region_postal_code' => '521', 'created_at' => now()],
            ['region_code' => 'lebk', 'region_name' => 'Lebak', 'region_postal_code' => '142', 'created_at' => now()],
            ['region_code' => 'tgrg', 'region_name' => 'Tangerang', 'region_postal_code' => '166', 'created_at' => now()],
            ['region_code' => 'bndg', 'region_name' => 'Bandung', 'region_postal_code' => '498', 'created_at' => now()],
            ['region_code' => 'bksi', 'region_name' => 'Bekasi', 'region_postal_code' => '115', 'created_at' => now()],
        ];

        Region::insert($data);
    }
}
