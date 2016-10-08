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
//use Illuminate\Http\Request;
use Log;

class TestController extends Controller
{
    public function __construct() {
        Log::debug('------->> TestController <<--------');
        Log::debug(Input::all());
    }
    public function test() {
        try {
            return Utility::genSuccessResp('test', $data=null);
        } catch (Exception $ex) {
            Utility::logException($ex);
            return Utility::genErrResp("internal_err");
        }
    }
}
