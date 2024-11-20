<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
// use PhpMqtt\Client\Facades\MQTT;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

// Schedule::job(function () {
//     $mqtt = MQTT::connection();
//     $mqtt->subscribe('iot/sensor', function (string $topic, string $message) {
//         echo sprintf('Received QoS level 1 message on topic [%s]: %s', $topic, $message);
//     }, 1);
//     $mqtt->loop(true);
// })->everyFiveSeconds();
