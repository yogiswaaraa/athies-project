<?php

namespace App\Filament\Resources\AcUnitResource\Pages;

use App\Filament\Resources\AcUnitResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification ;


class CreateAcUnit extends CreateRecord
{
    protected ?string $heading = 'Tambah Unit AC';
    protected static string $resource = AcUnitResource::class;
    protected function getCreatenotificationTittle(): ?string
    {
        return 'Ac Ditambahkan' ;
    }

    protected function getCreatenotification() : ?Notification
    {
        return Notification::make()
        ->succes()
        ->tittle('Ac Ditambahkan')
        ->body('Ac Berhasil Ditambahkan.') ;
    }
}
