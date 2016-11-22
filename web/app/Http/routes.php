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
Route::post('signup', array('middleware' => 'cors',"uses" => "AuthController@userSignUp"));
Route::post('otp_verification', array('middleware' => 'cors',"uses" => "AuthController@otpVerification"));
Route::post('login', array('middleware' => 'cors',"uses" => "AuthController@logIn"));
Route::post('logout', array('middleware' => 'cors',"uses" => "AuthController@logout"));
Route::post('is_logged_in', array("uses" => "AuthController@isLoggedIn"));

Route::post('insert_update_address', array("uses" => "AddressController@insertUpdateAddress"));
Route::post('insert_update_city', array("uses" => "AddressController@insertUpdateCity"));
Route::post('insert_update_order_type', array("uses" => "OrderMasterController@insertUpdateOrderType"));
Route::post('insert_update_order_sub_type', array("uses" => "OrderMasterController@insertUpdateOrderSubType"));
