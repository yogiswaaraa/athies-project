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

                ])
                ->action(function (array $data): void {
                    $dummy = [
                        'temperature' => 10,
                        'ac_unit_id' => 1,
                        'humidity' => 10,
                        'power_consumption' => 10
                    ];

                    $mqService = new RabbitMQService();


                    $mqService->publish(json_encode($dummy));

                    return;
                })
        ];
    }
}
