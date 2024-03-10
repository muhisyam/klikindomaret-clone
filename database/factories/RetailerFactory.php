<?php

namespace Database\Factories;

use App\Models\Region;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Retailer>
 */
class RetailerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $fake = fake('id_ID');

        return [
            'region_id' => Region::inRandomOrder()->first()->id,
            'supplier_id' => Supplier::inRandomOrder()->first()->id,
            'retailer_code' => $fake->unique()->regexify('[a-z0-9]{3}'),
            'retailer_name' => $fake->unique()->company(),
            'retailer_address' => $fake->unique()->address(),
            'opening_times' => $fake->time(),
            'closing_times' => $fake->time(),
            'longitude' => $fake->longitude(),
            'latitude' => $fake->latitude(),
        ];
    }
}
