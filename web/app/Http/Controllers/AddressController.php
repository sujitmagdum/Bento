<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use App\Models\City;
use App\Models\CustomerAddress;
use App\Helpers\Utility;
use Exception;
use DB;
use Response;
use App\Http\Controllers\Constants;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Log;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use JWTAuth;


class AddressController extends Controller {

    public function __construct() {
        Log::debug('------->> AddressController <<--------');
        Log::debug(Input::all());
    }

    public function insertUpdateCity(Request $request) {
        try {
            $id = Input::get('id');
            $name = Input::get('name');
            $validator = Validator::make(
                            [
                        'name' => $name,
                            ], [
                        'name' => array("required"),
                            ]
            );
            if ($validator->fails()) {
                return Utility::validation_err($validator);
            }
            if ($id == '' || $id == null) {
                $city_exist = City::where('name', $name)
                        ->count();
                if ($city_exist > 0)
                    return Utility::genErrResp('city_name_exist');
                $city = new City;
                $city->name = $name;
                $city->save();
                return Utility::genSuccessResp('city_add', null);
            }
            $city_exist = City::where('id', '!=', $id)
                    ->where('name', $name)
                    ->count();
            if ($city_exist > 0)
                return Utility::genErrResp('city_name_exist');

            $city = City::find($id);
            $city->name = $name;
            $city->save();
            return Utility::genSuccessResp('city_update', null);
        } catch (Exception $ex) {
            Utility::logException($ex);
            return Utility::genErrResp("internal_err");
        }
    }
    public function insertUpdateAddress(Request $request) {
        try {
            $id = Input::get('id');
            $user_id = Input::get('user_id');
            $food_type = Input::get('food_type');
            $address_type = Input::get('address_type');
            $address = Input::get('address');
            $validator = Validator::make(
                            [
                        'user_id' => $user_id,
                        'food_type' => $food_type,
                        'address_type' => $address_type,
                        'address' => $address,
                            ], [
                        'user_id' => array("required", 'exists:users,id,deleted_at,NULL'),
                        'food_type' => array("required"),
                        'address_type' => array("required"),
                        'address' => array("required"),
                            ]
            );
            if ($validator->fails()) {
                return Utility::validation_err($validator);
            }
            if ($id == '' || $id == null) {
                $address_exist = CustomerAddress::where('user_id', $user_id)
                        ->where('food_type', $food_type)
                        ->count();
                if ($address_exist > 0)
                    return Utility::genErrResp('address_exist');
                
                $cust_address = new CustomerAddress;
                $cust_address->user_id = $user_id;
                $cust_address->food_type = $food_type;
                $cust_address->address_type = $address_type;
                $cust_address->address = $address;
                
                $cust_address->save();
                return Utility::genSuccessResp('cust_address_add', null);   
            }
            $cust_address = CustomerAddress::find($id);
            $cust_address->user_id = $user_id;
            $cust_address->address_type = $address_type;
            $cust_address->address = $address;
            $cust_address->save();
            return Utility::genSuccessResp('cust_address_edit', null);
        } catch (Exception $ex) {
            Utility::logException($ex);
            return Utility::genErrResp("internal_err");
        }
    }

}
