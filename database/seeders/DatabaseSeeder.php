<?php

namespace Database\Seeders;

use App\Models\AcConditionLog;
use App\Models\AcUnit;
use App\Models\Building;
use App\Models\MaintenanceSchedule;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Sequence;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'yuanda',
            'email' => 'yuanda@mail.com',
            'password' => bcrypt('12345678'),
        ]);
        User::factory()->create([
            'name' => 'yuanda',
            'email' => 'yyuanda@athies.neroi.space',
            'password' => bcrypt('12345678'),
        ]);

        Building::factory()
            ->count(10)
            ->create();

        AcUnit::factory()
            ->count(50)
            ->create();

        MaintenanceSchedule::factory()
            ->count(10)
            ->create();

        AcConditionLog::factory()
            ->count(14)
            ->state(new Sequence(
                ['logged_at' => now()->subDays(6)],
                ['logged_at' => now()->subDays(6)],
                ['logged_at' => now()->subDays(5)],
                ['logged_at' => now()->subDays(5)],
                ['logged_at' => now()->subDays(4)],
                ['logged_at' => now()->subDays(4)],
                ['logged_at' => now()->subDays(3)],
                ['logged_at' => now()->subDays(3)],
                ['logged_at' => now()->subDays(2)],
                ['logged_at' => now()->subDays(2)],
                ['logged_at' => now()->subDays(1)],
                ['logged_at' => now()->subDays(1)],
                ['logged_at' => now()->subDays(0)],
                ['logged_at' => now()->subDays(0)],
            ))
            ->create();
    }
}
