<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Region>
 */
class RegionFactory extends Factory
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
            'region_code' => $fake->unique()->regexify('[a-z]{4}'),
            'region_name' => $fake->unique()->city(),
            'region_postal_code' => $fake->unique()->numberBetween(111, 999),
        ];
    }
}
