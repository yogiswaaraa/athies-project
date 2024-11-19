<?php

namespace App\Filament\Resources\AcUnitResource\Pages;

use App\Filament\Resources\AcUnitResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAcUnits extends ListRecords
{
    protected static string $resource = AcUnitResource::class;

    protected ?string $heading = 'Unit AC';

    protected function getHeaderWidgets(): array
    {
        return [
            AcUnitResource\Widgets\ACChart::class,
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
