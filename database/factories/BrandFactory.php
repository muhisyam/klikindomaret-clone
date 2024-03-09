<?php

namespace Database\Factories;

use App\Models\OfficialStore;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Brand>
 */
class BrandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $fake = fake('id_ID');
        $brandsName = $fake->unique()->company();

        return [
            'official_store_id' => OfficialStore::inRandomOrder()->first()->id,
            'brand_name' => $brandsName,
            'brand_slug' => Str::slug($brandsName),
        ];
    }
}
