<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\AcUnit;

class StatsOverview extends BaseWidget
{

    // protected static ?string $pollinginterval = '15s' ;

    // protected static bool $islazy = 'true' ; 

    protected function getStats(): array
    {

        $acUnitCount = AcUnit::count();

        return [

            // Stat::make(label:'total AC', value:'10k')

            Stat::make(label: 'Jumlah AC', value: $acUnitCount)
            ->description('Incrase In AC')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->color('success')
            ->chart([7, 3, 4, 5, 6, 3, 5, 3])
        ];
    }
}

