<?php

namespace Database\Factories;

use App\Models\AcUnit;
use App\Models\MaintenanceSchedule;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MaintenanceSchedule>
 */
class MaintenanceScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $completed_date = fake()->optional()->date('Y-m-d', now()->addMonths(1));



        return [
            'ac_unit_id' => AcUnit::factory(),
            'scheduled_date' => fake()->unique()->date('Y-m-d', now()->addMonths(2)),
            'type' => fake()->randomElement(MaintenanceSchedule::$types),
            'description' => fake()->sentence(),
            'completed_date' => $completed_date,
            'status' => $completed_date ? 'completed' : 'pending',
        ];
    }


    public function maintenance_done(): static
    {
        $is_completed = $this->states['completed_date'] ?? false;
        return $this->state(fn(array $attributes) => [
            'status' => $is_completed ? 'done' : 'pending',
        ]);
    }
}
