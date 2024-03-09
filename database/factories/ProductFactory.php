<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $fake = fake('id_ID');
        $productName = $fake->unique()->sentence(rand(3, 6));
        $productPrice = $fake->numberBetween(2000, 500000);

        if ($fake->boolean(30)) {
            $discountPrice = $fake->numberBetween(1000, $productPrice);
            $discountStart = now()->subDays(rand(1, 4));
            $discountEnd = now()->addDays(rand(4, 10));
        } else {
            $discountPrice = $discountStart = $discountEnd = null;
        }

        $deployStatus = $fake->boolean(15) ? 'Draft' : 'Publish';

        return [
            'category_id' => Category::whereDoesntHave('children')->inRandomOrder()->first(),
            'brand_id' => Brand::inRandomOrder()->first(),
            'supplier_id' => Supplier::inRandomOrder()->first(),
            'plu' => $fake->unique()->numberBetween(10000000, 59999999),
            'product_name' => $productName,
            'product_slug' => Str::slug($productName),
            'normal_price' => $productPrice,
            'discount_price' => $discountPrice,
            'discount_start_date' => $discountStart,
            'discount_end_date' => $discountEnd,
            'product_stock' => $fake->numberBetween(0, 2900),
            'product_deploy_status' => $deployStatus,
            'product_meta_keyword' => implode(', ', $fake->words(rand(1, 8))),
        ];
    }
}
