<?php

namespace Database\Factories;

use App\Models\AcUnit;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AcConditionLog>
 */
class AcConditionLogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $power_consumption = fake()->randomNumber(1, 10);
        $temperature = fake()->numberBetween(16, 25);
        $efficiency_rating = fake()->numberBetween(10, 12);

        return [
            'ac_unit_id' => AcUnit::factory(),
            'temperature' => $temperature,
            'humidity' => fake()->randomFloat(2, 40, 60),
            'power_consumption' => $power_consumption,
            'efficiency_rating' => $efficiency_rating,
            'logged_at' => now()->subDays(fake()->numberBetween(0, 6)),
        ];
    }
}
