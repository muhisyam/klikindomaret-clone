<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->template();
    }

    private function template()
    {
        $data = [
            ['flag_code' => 'f', 'flag_name' => 'store', 'supplier_name' => 'Indomaret', 'created_at' => now()],
            ['flag_code' => 't', 'flag_name' => 'fresh', 'supplier_name' => 'Indomaret Fresh', 'created_at' => now()],
            ['flag_code' => 'w', 'flag_name' => 'warehouse', 'supplier_name' => 'Warehouse', 'created_at' => now()],
            ['flag_code' => 's', 'flag_name' => 'seller', 'supplier_name' => 'Seller', 'created_at' => now()],
        ];

        Supplier::insert($data);
    }
}
