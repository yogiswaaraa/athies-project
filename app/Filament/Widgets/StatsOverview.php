<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget\IconPosition;
use Filament\Support\Colors\Color;
use Filament\Support\Facades\FilamentColor;
use App\Models\AcUnit;

FilamentColor::register([
    'yellow' => Color::hex('#FFC300'),
]);

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $acUnitCount = AcUnit::count();
        $activeCount = AcUnit::where('status', 'active')->count();
        $inactiveCount = AcUnit::where('status', 'inactive')->count();
        $maintenanceCount = AcUnit::where('status', 'maintenance')->count();

        // Menghitung rata-rata efisiensi untuk AC yang aktif
        $averageEfficiency = AcUnit::where('status', 'active')->avg('efficiency');

        // Mengembalikan statistik dalam bentuk array
        return [
            Stat::make('Total AC', $acUnitCount)
            ->description('Shows Total AC')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->chart([1,2,5,10,20,40])
            ->color('gray'), 

            Stat::make('AC is On', $activeCount)
            ->description('Shows Total AC in On Condition')
            ->descriptionIcon('heroicon-m-bolt')
            ->chart([3,3,3,3,3,3])
            ->color('info'),           
            
            Stat::make('AC is Off', $inactiveCount)
            ->description('Shows Total AC in Off Condition')
            ->descriptionIcon('heroicon-m-bolt-slash')
            ->chart([1,1,1,1,1])
            ->color('danger'),
            
            Stat::make('AC Maintenance', $maintenanceCount)
            ->description('Shows Total AC who Needs a Maintenance')
            ->descriptionIcon('heroicon-m-wrench-screwdriver')
            ->chart([2,2,2,2,2,2,2])
            ->color('yellow'),

            Stat::make('Average ERR', number_format($averageEfficiency, 2))
            ->description('Shows Avg of ERR AC')
            ->descriptionIcon('heroicon-m-sparkles')
            ->chart([11,11,11,11])
            ->color('success'),
            
        ];
    
    }
}
