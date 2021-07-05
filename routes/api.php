<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

$api = app('Dingo\Api\Routing\Router');

/***
 * Dingo-v1-api
 * /api/test
 */
$api->version('v1', function($api) {
    $api->get('test', function(){
        return 'this is test dingo api';
    })->name('api.v1.test');
});

/***
 * Dingo-v2-api
 * /api/test2
 * Header:
 * Accept:application/prs.laravel8.v2+json
 */
$api->version('v2', function($api){
    $api->get('test2', function(){
        return 'this is test dingo api 切换版本';
    });
});

// JWT + Dingo
$api->version('v1', function ($api) {

    /***
     * JWT-Token 获取
     * /api/login
     */
    $api->group(["namespace" => "App\Http\Controllers\Api\V1"], function ($api) {
        $api->post('login', 'UserController@login')->name('login');
        $api->get('carbon', 'CarbonController@index');
    });

    /***
     * JWT-Token 验证
     * /api/decode
     * Header:
     * Authorization: Bearer+空格+token
     */
    $api->group(["namespace" => "App\Http\Controllers\Api\V1",'middleware'=>'auth:api'], function ($api) {
        $api->post('decode', 'UserController@decode');
    });
});
