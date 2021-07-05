<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController;
use Carbon\Carbon;

class CarbonController extends BaseController
{
    public function index()
    {
        // 获取当天的时间 带时分秒
        return Carbon::now()->toDateTimeString();
    }
}
