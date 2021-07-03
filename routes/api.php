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
//这里的version是版本，里面的v1是在env里面定义好的。
$api->version('v1', function($api) {
    $api->get('test', function(){
        return 'this is test dingo api';
    })->name('api.v1.test');
});

//如果切换版本
$api->version('v2', function($api){
    $api->get('test2', function(){
        return 'this is test dingo api 切换版本';
    });
});

$api->version('v1',[
    'namespace'=>'App\Http\Controllers\Api\V1',
    //'middleware'=>['bindings']
], function($api) {
    $api->post('login', 'AuthController@login');
    $api->post('logout', 'AuthController@logout');
    $api->post('refresh', 'AuthController@refresh');
    $api->get('user','AuthController@user')->middleware('api:auth');
});
