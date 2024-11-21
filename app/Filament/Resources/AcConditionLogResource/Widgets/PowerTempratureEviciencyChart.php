<?php

namespace App\Filament\Resources\AcConditionLogResource\Widgets;

use Carbon\Carbon;
use App\Models\AcConditionLog;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;


class PowerTempratureEviciencyChart extends ChartWidget
{
    protected static ?string $heading = 'Daya, Tempratur, dan Efisiensi ';

    protected int | string | array $columnSpan = 'full';

    protected static ?string $pollingInterval = '1s';

    protected function getData(): array
    {
        $temprature_trend = Trend::model(AcConditionLog::class)
            ->dateColumn('logged_at')
            ->between(
                start: now()->subDays(6),
                end: now(),
            )
            ->perDay()
            ->average("temperature");

        $power_trend = Trend::model(AcConditionLog::class)
            ->dateColumn('logged_at')
            ->between(
                start: now()->subDays(6),
                end: now(),
            )
            ->perDay()
            ->average("power_consumption");

        $efficiency_rating_trend = Trend::model(AcConditionLog::class)
            ->dateColumn('logged_at')
            ->between(
                start: now()->subDays(6),
                end: now(),
            )
            ->perDay()
            ->average("efficiency_rating");

        return [
            'datasets' => [
                [
                    'label' => 'Tempratur',
                    'borderColor' => 'red',
                    'stepped' => true,
                    'data' => $temprature_trend->map(fn(TrendValue $value) => $value->aggregate),
                ],
                [
                    'label' => 'Daya',
                    'borderColor' => 'blue',
                    'stepped' => true,
                    'data' => $power_trend->map(fn(TrendValue $value) => $value->aggregate),
                ],
                [
                    'label' => 'Efisiensi',
                    'borderColor' => 'green',
                    'stepped' => true,
                    'data' => $efficiency_rating_trend->map(fn(TrendValue $value) => $value->aggregate),
                ],
            ],

            'labels' => $temprature_trend->map(fn(TrendValue $value) => $value->date),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
