<?php

namespace Database\Seeders;

use App\Models\AcUnit;
use App\Models\Building;
use App\Models\MaintenanceSchedule;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'yuanda',
        //     'email' => 'yuanda@mail.com',
        //     'password' => bcrypt('12345678'),
        // ]);

        Building::factory()
            ->count(10)
            ->create();

        AcUnit::factory()
            ->count(50)
            ->create();

        MaintenanceSchedule::factory()
            ->count(10)
            ->create();
    }
}
