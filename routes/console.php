<?php

use App\Models\MaintenanceSchedule;
use App\Models\User;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use Illuminate\Support\Facades\DB;

use Filament\Notifications\Notification;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::call(function () {
    DB::table('maintenance_schedules')->delete();
})->daily();

Schedule::call(function () {
    $schedules = MaintenanceSchedule::query()
        ->where('status', '!=', 'completed')
        ->where('scheduled_date', '>=', now())
        ->all();

    foreach ($schedules as $schedule) {
        Notification::make()
            ->title('Pending Maintenance Notification')
            ->body("Maintenance schedule for AC Unit ID {$schedule->ac_unit_id} is pending.")
            ->sendToDatabase(User::where('id', '=', '1')->get());
    }
})->daily();