<?php

namespace App\Filament\Resources\MaintenanceScheduleResource\Pages;

use App\Filament\Resources\MaintenanceScheduleResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMaintenanceSchedules extends ListRecords
{
    protected static string $resource = MaintenanceScheduleResource::class;
    protected ?string $heading = 'Jadwal Pemeliharaan';

    protected function getHeaderWidgets(): array
    {
        return [
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
