<?php

use Illuminate\Http\Request;

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
Route::post('login', 'API\UserController@login');
Route::post('register', 'API\UserController@register');
Route::group(['middleware' => 'auth:api'], function()
{
   Route::get('orders', 'API\OrderController@orders');
   Route::get('ordersdetails/{id}', 'API\OrderController@show');
   Route::post('ordersdetails/{id}', 'API\OrderController@update');
   Route::get('repairmen', 'API\RepairmanController@repairmen');
   Route::get('services', 'API\ServiceController@services');
   Route::get('areas', 'API\AreaController@areas');
   Route::post('createorder', 'API\OrderController@createorder');
   Route::post('createorderdetails', 'API\OrderController@createorderdetails');
   Route::get('details', 'API\UserController@getUser');
});
