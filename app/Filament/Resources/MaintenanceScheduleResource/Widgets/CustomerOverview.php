<?php

namespace App\Filament\Resources\MaintenanceScheduleResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class CustomerOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make(label:'Pending',value:'0')
        ];
    }
}
