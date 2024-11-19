<?php

namespace App\Filament\Resources\MaintenanceHistoryResource\Pages;

use App\Filament\Resources\MaintenanceHistoryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMaintenanceHistory extends CreateRecord
{
    protected ?string $heading = 'Tambah riwayat Jadwal Pemeliharaan';
    protected static string $resource = MaintenanceHistoryResource::class;
}
