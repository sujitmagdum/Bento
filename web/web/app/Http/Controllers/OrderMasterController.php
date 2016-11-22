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
use App\Models\OrderType;
use App\Models\OrderSubType;

class OrderMasterController extends Controller {

    public function __construct() {
        Log::debug('------->> OrderMasterController <<--------');
        Log::debug(Input::all());
    }

    public function insertUpdateOrderType(Request $request) {
        try {
            $id = Input::get('id');
            $name = Input::get('name');
            $order_start_time = Input::get('order_start_time');
            $order_end_time = Input::get('order_end_time');
            $is_active = Input::get('is_active');
            $validator = Validator::make(
                            [
                        'name' => $name,
                        'is_active' => $is_active,
                        'order_start_time' => $order_start_time,
                        'order_end_time' => $order_end_time,
                            ], [
                        'name' => array("required"),
                        'is_active' => array("required"),
                        'order_start_time' => array("required"),
                        'order_end_time' => array("required"),
                            ]
            );
            if ($validator->fails()) {
                DB::rollback();
                return Utility::validation_err($validator);
            }
            if ($id == '' || $id == null) {
                $order_type_exist = OrderType::where('name', $name)
                        ->count();
                if ($order_type_exist > 0)
                    return Utility::genErrResp('order_type_exist');
                $order_type = new OrderType;
                $order_type->name = $name;
                $order_type->is_active = $is_active;
                $order_type->order_start_time = $order_start_time;
                $order_type->order_end_time = $order_end_time;
                $order_type->save();
                return Utility::genSuccessResp('order_type_add', null);
            }
            $order_type_exist = OrderType::where('id', '!=', $id)
                    ->where('name', $name)
                    ->count();
            if ($order_type_exist > 0)
                return Utility::genErrResp('order_type_exist');

            $order_type = OrderType::find($id);
            $order_type->name = $name;
            $order_type->is_active = $is_active;
            $order_type->order_start_time = $order_start_time;
            $order_type->order_end_time = $order_end_time;
            $order_type->save();
            return Utility::genSuccessResp('order_type_update', null);
        } catch (Exception $ex) {
            Utility::logException($ex);
            return Utility::genErrResp("internal_err");
        }
    }

    public function insertUpdateOrderSubType(Request $request) {
        try {
            $id = Input::get('id');
            $order_type_id = Input::get('order_type_id');
            $name = Input::get('name');
            $price = Input::get('price');
            $validator = Validator::make(
                            [
                        'order_type_id' => $order_type_id,
                        'name' => $name,
                        'price' => $price
                            ], [
                        'order_type_id' => array("required", "integer", 'exists:order_type,id,deleted_at,NULL'),
                        'name' => array("required"),
                        'price' => array("required", "numeric"),
                            ]
            );
            if ($validator->fails()) {
                DB::rollback();
                return Utility::validation_err($validator);
            }
            if ($id == '' || $id == null) {
                $order_sub_type_exist = OrderSubType::where('name', $name)
                        ->count();
                if ($order_sub_type_exist > 0)
                    return Utility::genErrResp('order_sub_type_exist');
                $order_sub_type = new OrderSubType;
                $order_sub_type->order_type_id = $order_type_id;
                $order_sub_type->name = $name;
                $order_sub_type->price = $price;
                $order_sub_type->save();
                return Utility::genSuccessResp('order_sub_type_add', null);
            }
            $order_type_exist = OrderSubType::where('id', '!=', $id)
                    ->where('name', $name)
                    ->count();
            if ($order_type_exist > 0)
                return Utility::genErrResp('order_sub_type_exist');

            $order_sub_type = OrderSubType::find($id);
            $order_sub_type->order_type_id = $order_type_id;
            $order_sub_type->name = $name;
            $order_sub_type->price = $price;
            $order_sub_type->save();
            return Utility::genSuccessResp('order_sub_type_update', null);
        } catch (Exception $ex) {
            Utility::logException($ex);
            return Utility::genErrResp("internal_err");
        }
    }

}
