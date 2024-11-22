<?php

namespace App\Filament\Exports;

use App\Models\AcConditionLog;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class AcConditionLogExporter extends Exporter
{
    protected static ?string $model = AcConditionLog::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('acUnit.unit_code')
                ->label('AC Unit'),
            ExportColumn::make('acUnit.serial_number')
                ->label('AC Serial Number'),
            ExportColumn::make('temperature'),
            ExportColumn::make('humidity'),
            ExportColumn::make('power_consumption'),
            ExportColumn::make('efficiency_rating'),
            ExportColumn::make('logged_at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your ac condition log export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
