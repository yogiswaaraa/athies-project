<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget\IconPosition;
use Filament\Support\Colors\Color;
use Filament\Support\Facades\FilamentColor;
use App\Models\AcUnit;

FilamentColor::register([
    'purple' => Color::hex('#5f1796'),
    'dark-yellow' => Color::hex('#967f17')
]);

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $acUnitCount = AcUnit::count();
        $activeCount = AcUnit::where('status', 'active')->count();
        $inactiveCount = AcUnit::where('status', 'inactive')->count();
        $workingwellCount = AcUnit::where('current_condition', 'normal')->count();
        $malfunctioningCount = AcUnit::where('current_condition', 'broken')->count();
        $maintenanceCount = AcUnit::where('status', 'maintenance')->count();
        
         // Hitung rata-rata efisiensi hanya untuk AC aktif
         $averageEfficiencyActive = AcUnit::where('status', 'active')
         ->join('ac_condition_logs', 'ac_units.id', '=', 'ac_condition_logs.ac_unit_id')
         ->avg('ac_condition_logs.efficiency_rating');

        // Mengembalikan statistik dalam bentuk array
        return [
            Stat::make('Total AC', $acUnitCount)
            ->description('Shows Total AC')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->chart([10,10,10,10])
            ->color('gray'),
            #->columnSpan(1), 

            Stat::make('On', $activeCount)
            ->description('Shows Total AC in On Condition')
            ->descriptionIcon('heroicon-m-bolt')
            ->chart([3,3,3,3,3,3])
            ->color('info'),           
            
            Stat::make('Off', $inactiveCount)
            ->description('Shows Total AC in Off Condition')
            ->descriptionIcon('heroicon-m-bolt-slash')
            ->chart([1,1,1,1,1])
            ->color('danger'),

            Stat::make('Working Well AC', $workingwellCount)
            ->description('Shows Total AC in Working Well Condition')
            ->descriptionIcon('heroicon-m-check')
            ->chart([3,3,3,3,3,3])
            ->color('success'),           
            
            Stat::make('Malfunctioning', $malfunctioningCount)
            ->description('Shows Total AC in Malfunction Condition')
            ->descriptionIcon('heroicon-m-bug-ant')
            ->chart([1,1,1,1,1])
            ->color('warning'),
            
            // Stat::make('AC Maintenance', $maintenanceCount)
            // ->description('Shows Total AC who Needs a Maintenance')
            // ->descriptionIcon('heroicon-m-wrench-screwdriver')
            // ->chart([2,2,2,2,2,2,2])
            // ->color('yellow'),

            Stat::make('Average ERR', number_format((float)$averageEfficiencyActive, 1,'.',''))
            ->description('Shows Avg of ERR AC')
            ->descriptionIcon('heroicon-m-sparkles')
            ->chart([11,11,11,11])
            ->color('purple'),
            
            Stat::make('Cost', value: '1,000K')
            ->description('Total Maintenance Cost In November')
            ->descriptionIcon('heroicon-m-currency-dollar')
            ->chart([1,2,4,10,20,50])
            ->color('dark-yellow')
        ];
    
    }
}
