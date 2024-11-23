<?php

namespace App\Filament\Resources\MaintenanceScheduleResource\Pages;

use App\Filament\Resources\MaintenanceScheduleResource;
use App\Filament\Resources\MaintenanceScheduleResource\Widgets\CalendarWidget;
use App\Filament\Resources\MaintenanceScheduleResource\Widgets\CustomerOverview;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMaintenanceSchedules extends ListRecords
{
    protected static string $resource = MaintenanceScheduleResource::class;
    protected ?string $heading = 'Jadwal Pemeliharaan';
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
    protected function getHeaderWidgets(): array
    {
        return [
            CustomerOverview::class,
            CalendarWidget::class,
        ];
    }
}
