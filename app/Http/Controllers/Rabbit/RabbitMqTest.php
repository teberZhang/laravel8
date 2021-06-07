<?php

namespace App\Http\Controllers\Rabbit;

use App\Jobs\RabbitMqTestJob;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RabbitMqTest extends Controller
{
    public function index()
    {
        $this->dispatch(new RabbitMqTestJob(['id' => 10, 'name' => 'jack']));
        return 'success';
    }
}
