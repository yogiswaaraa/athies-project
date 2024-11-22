<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\RabbitMQService;
use Carbon\Carbon;

class MQPublishCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mq:publish-test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $mqService = new RabbitMQService();

        while (true) {
            $dummy = [
                'temperature' => fake()->randomFloat(2, 20, 30),
                'ac_unit_id' => fake()->randomNumber(1, 10),
                'humidity' => fake()->randomFloat(2, 40, 60),
                'power_consumption' => fake()->randomNumber(1, 10),
                'logged_at' => fake()->dateTimeBetween('-1 week', 'now')->format('Y-m-d\TH:i:s.u\Z'),
            ];

            $mqService->publish(json_encode($dummy));
            sleep(1); // Add a delay of 1 second
        }
    }
}
