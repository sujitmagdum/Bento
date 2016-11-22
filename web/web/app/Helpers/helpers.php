<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Helpers;

use App\Http\Controllers\Controller;
use Log;
use DB;
use Config;
use Input;
use Request;
use App\Http\Controllers\Constants;
//use Illuminate\Support\Facades\Validator;
use Hash;
use Exception;
use DateTime;
use Carbon\Carbon;

class Utility {

    public static function validation_err($validator) {
        $messages = $validator->messages()->all();
        $validErr['status'] = 'ERROR';
        foreach ($messages as $msg) {
            $validErr['messages'][] = $msg;
        }
        $json = json_encode($validErr);
        $remove = array("\\r\\n", "\\n", "\\r", "\\");
        $jsonstr = str_replace($remove, "", trim($json));
        Log::debug("--------------------Validation Messages----------------------");
        Log::debug(json_encode($validErr));
        return $jsonstr;
    }

    public static function genErrResp($code = "internal_err", $data = null, $msg = null) {
        try {
            if ($msg === null) {
                $intErr = "Internal Error";
                if (is_array($code)) {
                    foreach ($code as $index => $single_code) {
                        $single_msg = config((strpos($single_code, ".") === false) ? "validation_message." . $single_code : $single_code);
                        $msg[$index] = isset($single_msg) ? $single_msg : $intErr;
                    }
                } else {
                    $single_msg = config((strpos($code, ".") === false) ? "validation_message." . $code : $code);
                    $msg[0] = isset($single_msg) ? $single_msg : $intErr;
                }
            } else {
                $msg[0] = $msg;
            }
            $respData[Constants::STATUS] = Constants::ERR;
            $respData[Constants::MESSAGES] = array_values($msg);
            $respData[Constants::CODE] = $code;
            $respData[Constants::DATA] = $data;
        } catch (Exception $ex) {
            Log::debug("exception: " . $ex);
        }
        Log::debug("genErrResp respData:-->>>>>>>>>");
        Log::debug($respData);
        return json_encode($respData, JSON_FORCE_OBJECT);
    }

    public static function genSuccessResp($code = "internal_err", $data = null, $is_format = true) {
        try {
            if (is_array($code)) {
                foreach ($code as $index => $single_code) {
                    $single_msg = config((strpos($single_code, ".") === false) ? "validation_message." . $single_code : $single_code);
                    $intErr = "Validation message file doesn't contain code:- " . $single_code;
                    $msg[$index] = isset($single_msg) ? $single_msg : $intErr;
                }
            } else {
                $single_msg = config((strpos($code, ".") === false) ? "validation_message." . $code : $code);
                $intErr = "Validation message file doesn't contain code:- " . $code;
                $msg[0] = isset($single_msg) ? $single_msg : $intErr;
            }
            $respData[Constants::STATUS] = Constants::SUCCESS;
            $respData[Constants::MESSAGES] = $msg;
            $respData[Constants::DATA] = $data;
        } catch (Exception $ex) {
            Log::debug("exception: " . $ex);
        }
        Log::debug("genSuccessResp respData:-->>>>>>>>>");
        Log::debug(json_encode($respData));
        if ($is_format)
            return json_encode($respData, JSON_FORCE_OBJECT);
        return json_encode($respData);
    }

    public static function logException($ex) {
        try {
            Log::debug("Exception found :-------->>>>");
            Log::debug($ex);
        } catch (Exception $exception) {
            Log::debug("Exception found in logException :-" . $exception);
        }
    }

}
