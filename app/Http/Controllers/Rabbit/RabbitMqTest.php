<?php

namespace App\Http\Controllers\Rabbit;

use App\Jobs\RabbitMqTestJob;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RabbitMqTest extends Controller
{
    public function index()
    {
        RabbitMqTestJob::dispatch(['id' => rand(1000, 9999), 'name' => 'jack', 'time' => date("H:i:s")])->onQueue('sqs');
        return 'success';
    }
}
