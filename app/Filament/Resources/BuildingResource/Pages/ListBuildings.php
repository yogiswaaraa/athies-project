<?php

namespace App\Filament\Resources\BuildingResource\Pages;


use App\Filament\Resources\BuildingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBuildings extends ListRecords
{
    protected static string $resource = BuildingResource::class;
    protected ?string $heading = 'Daftar Gedung';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
