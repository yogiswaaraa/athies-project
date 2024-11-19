<?php

namespace App\Filament\Resources\AcConditionLogResource\Pages;

use App\Filament\Resources\AcConditionLogResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAcConditionLogs extends ListRecords
{
    protected static string $resource = AcConditionLogResource::class;

    protected ?string $heading = 'Riwayat Kondisi Unit AC';
    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
