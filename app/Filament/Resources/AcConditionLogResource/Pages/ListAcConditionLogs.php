<?php

namespace App\Filament\Resources\AcConditionLogResource\Pages;

use App\Filament\Resources\AcConditionLogResource;
use App\Filament\Resources\AcConditionLogResource\Widgets;
use App\Models\AcConditionLog;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\View\View;
use App\Services\RabbitMQService;
use Carbon\Carbon;

class ListAcConditionLogs extends ListRecords
{
    protected static string $resource = AcConditionLogResource::class;

    protected ?string $heading = 'Riwayat Kondisi Unit AC';


    public function publishMessage($sub_day = 0): void
    {
        $mqService = new RabbitMQService();
        $dummy = [
            'temperature' => fake()->randomFloat(2, 20, 30),
            'ac_unit_id' => fake()->randomNumber(1, 10),
            'humidity' => fake()->randomFloat(2, 40, 60),
            'power_consumption' => fake()->randomNumber(1, 10),
            'logged_at' => Carbon::now()->subDays($sub_day),
        ];

        $mqService->publish(json_encode($dummy));
    }

    public function publishNTimes(int $n): void
    {
        for ($i = 0; $i < $n; $i++) {
            $this->publishMessage($n - $i);
        }
    }

    public function reset_data(): void
    {
        AcConditionLog::truncate();
    }

    protected function getHeaderWidgets(): array
    {
        return [
            Widgets\PowerTempratureEviciencyChart::class
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),

            Action::make('test_mqtt')
                ->label('Test MQTT')
                ->modalContent(fn(): View => view(
                    'livewire.mqtt-publish-test',
                ))->modalSubmitAction(false)
        ];
    }
}
