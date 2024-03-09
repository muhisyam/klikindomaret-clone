<?php

namespace Database\Factories;

use App\Enums\SelectSpesificRoute;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OfficialStore>
 */
class OfficialStoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $fake = fake('id_ID');
        $storeName = $fake->unique()->company();

        return [
            'store_name' => $storeName,
            'store_slug' => Str::slug($storeName),
            'store_description' => $fake->text(30),
            'store_redirect_url' => null,
        ];
    }
}
