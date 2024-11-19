<?php

namespace App\Filament\Resources\MaintenanceScheduleResource\Widgets;

use Filament\Widgets\ChartWidget;

class KetepatanPerawatan extends ChartWidget
{
    protected static ?string $heading = 'Ketepatan Perawatan AC';

    protected function getData(): array
    {
        return [
            'labels' => ['Terlambat', 'Tepat Waktu'], // Label untuk sumbu X
        'datasets' => [
            [
                'label' => 'Data 1',
                'data' => [5, 95], // Data untuk masing-masing label
                'backgroundColor' => ['#FF5733', '#33FF57'], // Warna untuk tiap sektor
            ],
        ],
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
