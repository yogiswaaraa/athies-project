<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\AcUnit;

class ACStatusChart extends ChartWidget
{
    protected static ?string $heading = 'AC Status';

    protected function getData(): array
    {
        // Dynamically count the AC units based on their status
        $activeCount = AcUnit::where('status', 'active')->count();
        $inactiveCount = AcUnit::where('status', 'inactive')->count();
        //$maintenanceCount = AcUnit::where('status', 'maintenance')->count();

        return [
            'labels' => ['On', 'Off'],  // Labels for the X-axis
            'datasets' => [
                [
                    'label' => 'Count',
                    'data' => [$activeCount, $inactiveCount], //$maintenanceCount],  // Use dynamic counts here
                    'backgroundColor' => ['#5463FF', '#FF1818'],  // Color for each bar
                    'borderColor' => ['#ECECEC'],  // Border color for bars
                    'borderWidth' => 2,  // Set border width if needed
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'bar';  // Change to bar chart type
    }
}
