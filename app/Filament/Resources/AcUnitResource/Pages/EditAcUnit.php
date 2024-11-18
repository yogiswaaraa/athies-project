<?php

namespace App\Filament\Resources\AcUnitResource\Pages;

use App\Filament\Resources\AcUnitResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAcUnit extends EditRecord
{
    protected static string $resource = AcUnitResource::class;
    protected ?string $heading = 'Ubah Unit AC';

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
