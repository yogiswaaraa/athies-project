<?php

namespace App\Console\Commands;

use App\Models\AcConditionLog;
use Illuminate\Console\Command;
use App\Services\RabbitMQService;

class MQConsumerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mq:consume';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Consume the mq queue';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $mqService = new RabbitMQService();

        $callback = function ($msg) {
            $payload_string = $msg->body;
            $payload = json_decode($payload_string, true);

            echo " [x] Received ", $payload_string, "\n";

            // TODO: Calculate real efficiency rating
            $efficiency_rating = $payload['power_consumption'] / $payload['temperature'];

            AcConditionLog::create([
                'ac_unit_id' => $payload['ac_unit_id'],
                'temperature' => floatval($payload['temperature']),
                'humidity' => $payload['humidity'],
                'power_consumption' => $payload['power_consumption'],
                'efficiency_rating' => $efficiency_rating,
                'logged_at' => $payload['logged_at'],
            ]);
        };

        $mqService->consume($callback);
    }
}
