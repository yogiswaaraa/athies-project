<?php

namespace App\Filament\Exports;

use App\Models\AcUnit;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class AcUnitExporter extends Exporter
{
    protected static ?string $model = AcUnit::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('building.name'),
            ExportColumn::make('unit_code'),
            ExportColumn::make('model'),
            ExportColumn::make('serial_number'),
            ExportColumn::make('status'),
            ExportColumn::make('installation_date'),
            ExportColumn::make('maintenanceSchedules_count')
                ->label('Jumlah Jadwal Pemeliharaan')
                ->default('0'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your ac unit export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
