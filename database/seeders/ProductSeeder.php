<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductDescription;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::factory(3)
            ->hasImages(1)
            ->hasDescriptions(1)
            ->create();
    }
}
