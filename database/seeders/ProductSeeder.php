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
        for ($i=0; $i < 2481; $i++) { 
            Product::factory()
                ->hasImages(1)
                ->hasDescriptions(rand(1, 4))
                ->create();
        }
    }
}
