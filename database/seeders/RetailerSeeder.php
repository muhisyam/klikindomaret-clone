<?php

namespace Database\Seeders;

use App\Models\Retailer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RetailerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->template();

        Retailer::factory(472)->create();
    }

    private function template()
    {
        $data = [
            ['region_id' => '1', 'supplier_id' => '2', 'retailer_code' => 'x78', 'retailer_name' => 'Fresh Gejayan', 'retailer_address' => 'Jl Gejayan 31a Rt04/02 Kel Caturtunggal, Kec Depok, Kab Sleman, Yogyakarta, 55281', 'retailer_open' => 'Open', 'opening_times' => now(), 'closing_times' => now()->addHours(5), 'longitude' => '-7.764073', 'latitude' => '110.409104', 'created_at' => now()],
            ['region_id' => '2', 'supplier_id' => '1', 'retailer_code' => 'ty1', 'retailer_name' => 'Perumnas Cibeber', 'retailer_address' => 'Komp Perumnas Cibeber Kencana Blok D19/11 Kel Cibeber, Kec Cibeber, Kota Cilegon, 42423', 'retailer_open' => 'Open', 'opening_times' => now(), 'closing_times' => now()->addHours(8), 'longitude' => '-7.764510', 'latitude' => '110.409104', 'created_at' => now()],
            ['region_id' => '3', 'supplier_id' => '3', 'retailer_code' => 'bnv', 'retailer_name' => 'Warehouse Jakarta 1', 'retailer_address' => 'Jakarta Pusat, DKI Jakarta, 11255', 'retailer_open' => 'Open', 'opening_times' => now(), 'closing_times' => now()->addHours(12), 'longitude' => '-7.765828', 'latitude' => '110.410490', 'created_at' => now()],
            ['region_id' => '4', 'supplier_id' => '3', 'retailer_code' => 'kj9', 'retailer_name' => 'Warehouse Cikande 2', 'retailer_address' => 'Cikande, Sukabumi, 15572', 'retailer_open' => 'Close', 'opening_times' => now(), 'closing_times' => now()->addHours(5), 'longitude' => '-7.762192', 'latitude' => '110.406237', 'created_at' => now()],
            ['region_id' => '5', 'supplier_id' => '4', 'retailer_code' => 'sl1', 'retailer_name' => 'Eat Sambel', 'retailer_address' => 'Jl Suka Aza Bogor, 11312', 'retailer_open' => 'Close', 'opening_times' => now(), 'closing_times' => now()->addHours(4), 'longitude' => '-7.768604', 'latitude' => '110.408930', 'created_at' => now()],
        ];

        Retailer::insert($data);
    }
}
