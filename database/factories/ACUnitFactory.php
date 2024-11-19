<?php

namespace Database\Factories;

use App\Models\AcUnit;
use App\Models\Building;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AcUnit>
 */
class ACUnitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'building_id' => Building::factory(),
            'unit_code' => fake()->unique()->lexify('id-????'),
            'model' => fake()->randomElement(AcUnit::$ac_models),
            'serial_number' => fake()->unique()->lexify('SN-????'),
            'status' => fake()->randomElement(AcUnit::$ac_statuses),
            'current_temperature' => fake()->optional()->randomFloat(2, 16, 30),
            'efficiency_rating' => fake()->optional()->randomFloat(2, 1, 5),
            'installation_date' => fake()->date(),
        ];
    }
}
