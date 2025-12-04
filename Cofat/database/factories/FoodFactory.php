<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Food>
 */
class FoodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $releaseDate = $this->faker->dateTimeBetween('-1 year', 'now');
        $expiredDate = Carbon::parse($releaseDate)->addDays($this->faker->numberBetween(1, 365));

        return [
            'name' => $this->faker->word,
            'ingredient' => $this->faker->sentence,
            'quantity' => $this->faker->numberBetween(1, 100),
            'release_date' => $releaseDate,
            'expired_date' => $expiredDate,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}