<?php

namespace App\Filament\Resources\AcUnitResource\Pages;

use App\Filament\Resources\AcUnitResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;


class CreateAcUnit extends CreateRecord
{
    protected ?string $heading = 'Tambah Unit AC';
    protected static string $resource = AcUnitResource::class;
}
