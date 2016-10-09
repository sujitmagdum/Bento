<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Helpers\Utility;
use Exception;
use DB;
use Response;
use App\Http\Controllers\Constants;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Log;
use App\Models\City;

class AddressMasterController extends Controller {

    public function __construct() {
        Log::debug('------->> AddressMasterController <<--------');
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
                DB::rollback();
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

}
