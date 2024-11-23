<?php

namespace App\Filament\Resources\MaintenanceScheduleResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\MaintenanceSchedule;

class CustomerOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $pendingCount = MaintenanceSchedule::where('status', 'pending')->count();
        $completedCount = MaintenanceSchedule::where('status', 'completed')->count();
        $cancelledCount = MaintenanceSchedule::where('status', 'cancelled')->count();

        return [
            Stat::make(label: 'Completed', value: $completedCount),
            Stat::make(label: 'Pending', value: $pendingCount),
            Stat::make(label: 'Cancelled', value: $cancelledCount),
        ];
    }
}
