<?php

namespace App\Filament\Resources\AcConditionLogResource\Pages;

use App\Filament\Resources\AcConditionLogResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAcConditionLog extends EditRecord
{
    protected static string $resource = AcConditionLogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
