<?php

namespace Database\Seeders;

use App\Models\Store;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['region_id' => '1', 'supplier_id' => '2', 'store_code' => 'x78', 'store_name' => 'Fresh Gejayan', 'store_address' => 'Jl Gejayan 31a Rt04/02 Kel Caturtunggal, Kec Depok, Kab Sleman, Yogyakarta, 55281', 'store_open' => 'Open', 'opening_times' => now(), 'closing_times' => now()->addHours(5), 'longitude' => '-7.764073', 'latitude' => '110.409104', 'created_at' => now()],
            ['region_id' => '2', 'supplier_id' => '1', 'store_code' => 'ty1', 'store_name' => 'Perumnas Cibeber', 'store_address' => 'Komp Perumnas Cibeber Kencana Blok D19/11 Kel Cibeber, Kec Cibeber, Kota Cilegon, 42423', 'store_open' => 'Open', 'opening_times' => now(), 'closing_times' => now()->addHours(8), 'longitude' => '-7.764510', 'latitude' => '110.409104', 'created_at' => now()],
            ['region_id' => '3', 'supplier_id' => '3', 'store_code' => 'bnv', 'store_name' => 'Warehouse Jakarta 1', 'store_address' => 'Jakarta Pusat, DKI Jakarta, 11255', 'store_open' => 'Open', 'opening_times' => now(), 'closing_times' => now()->addHours(12), 'longitude' => '-7.765828', 'latitude' => '110.410490', 'created_at' => now()],
            ['region_id' => '4', 'supplier_id' => '3', 'store_code' => 'kj9', 'store_name' => 'Warehouse Cikande 2', 'store_address' => 'Cikande, Sukabumi, 15572', 'store_open' => 'Close', 'opening_times' => now(), 'closing_times' => now()->addHours(5), 'longitude' => '-7.762192', 'latitude' => '110.406237', 'created_at' => now()],
            ['region_id' => '5', 'supplier_id' => '4', 'store_code' => 'sl1', 'store_name' => 'Eat Sambel', 'store_address' => 'Jl Suka Aza Bogor, 11312', 'store_open' => 'Close', 'opening_times' => now(), 'closing_times' => now()->addHours(4), 'longitude' => '-7.768604', 'latitude' => '110.408930', 'created_at' => now()],
        ];

        Store::insert($data);
    }
}
