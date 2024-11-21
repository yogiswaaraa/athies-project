<?php

namespace App\Filament\Resources\AcConditionLogResource\Pages;

use App\Filament\Resources\AcConditionLogResource;
use App\Services\RabbitMQService;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;
use Filament\Forms;

class ListAcConditionLogs extends ListRecords
{
    protected static string $resource = AcConditionLogResource::class;

    protected ?string $heading = 'Riwayat Kondisi Unit AC';
    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),

            Action::make('test_mqtt')
                ->label('Test MQTT')
                ->form([
                    // AcConditionLogResource::schema()
                    Forms\Components\TextInput::make('temperature')
                        ->required()
                ])
                ->action(function (array $data): void {
                    $mqService = new RabbitMQService();
                    $mqService->publish("{temprature: 10}");

                    return;
                })
        ];
    }
}
