<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\AcUnit;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $acUnitCount = AcUnit::count();

        // Mengembalikan statistik dalam bentuk array
        return [
            Stat::make(label: 'Jumlah AC', value: $acUnitCount)
        ];
    }
}
