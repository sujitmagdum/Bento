<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::post('insert_update_city', array("uses" => "AddressMasterController@insertUpdateCity"));
Route::post('insert_update_order_type', array("uses" => "OrderMasterController@insertUpdateOrderType"));
Route::post('insert_update_order_sub_type', array("uses" => "OrderMasterController@insertUpdateOrderSubType"));
