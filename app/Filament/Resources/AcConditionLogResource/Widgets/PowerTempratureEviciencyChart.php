<?php

namespace App\Filament\Resources\AcConditionLogResource\Widgets;

use Carbon\Carbon;
use App\Models\AcConditionLog;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Illuminate\Support\Facades\Log;

class PowerTempratureEviciencyChart extends ChartWidget
{
    protected static ?string $heading = 'Rata-Rata Daya, Tempratur, dan Efisiensi ';

    protected int | string | array $columnSpan = 'full';

    protected static ?string $pollingInterval = '5s';

    protected static ?string $maxHeight = '300px';

    protected function getData(): array
    {
        $max_tempraure = AcConditionLog::max('temperature');

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
                    // 'stepped' => true,
                    "cubicInterpolationMode" => 'monotone',
                    'data' => $temprature_trend->map(fn(TrendValue $value) => $value->aggregate),
                ],
                [
                    'label' => 'Daya',
                    'borderColor' => 'blue',
                    // 'stepped' => true,
                    "cubicInterpolationMode" => 'monotone',
                    'data' => $power_trend->map(fn(TrendValue $value) => $value->aggregate),
                ],
                [
                    'label' => 'Efisiensi',
                    'borderColor' => 'green',
                    // 'stepped' => true,
                    "cubicInterpolationMode" => 'monotone',
                    'data' => $efficiency_rating_trend->map(fn(TrendValue $value) => $value->aggregate * $max_tempraure),
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
