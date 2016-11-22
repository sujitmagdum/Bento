<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use App\Models\Otp;
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

class AuthController extends Controller {

    public function __construct() {
        Log::debug('------->> AuthController <<--------');
        Log::debug(Input::all());
    }

    public function userSignUp(Request $request) {
        try {
            DB::beginTransaction();
            $name = Input::get('name');
            $gender = Input::get('gender');
            $phone = Input::get('phone');
            $password = Input::get('password');
            $cust_id = Input::get('cust_id');
            $email = Input::get('email');
            $last_logged_in = date('Y-m-d H:i:s');
            $validator = Validator::make(
                            [
                        'name' => $name,
                        'gender' => $gender,
                        'phone' => $phone,
                        'password' => $password,
                        'cust_id' => $cust_id,
                        'email' => $email
                            ], [
                        'name' => array("required"),
                        'gender' => array("required"),
                        'phone' => array("required", "unique:users"),
                        'password' => array("required"),
                        'cust_id' => array("required"),
                        'email' => array("email"),
                            ]
            );
            if ($validator->fails()) {
                DB::rollback();
                return Utility::validation_err($validator);
            }
            $password1=$password;
            $user = new User;
            $user->name = $name;
            $user->gender = $gender;
            $user->phone = $phone;
            $user->password = bcrypt($password1);
            $user->cust_id = $cust_id;
            $user->type = "customer";
            $user->email = $email;
            $user->last_logged_in = $last_logged_in;
            $user->is_active = "n";
            $user->save();

            $otp_val = Utility::generateOtp();
            $otp = new Otp;
            $otp->user_id = $user->id;
            $otp->otp = $otp_val;
            $otp->phone_no = $user->phone;
            $otp->status = "p";
            $otp->save();

//            $username = "sujitm";
//            $apikey = "aKyrpQVNJla3fUBqJszZ";
//            $senderid = "MYTEXT";
//            $mobile = $phone;
//            $message = "Please enter your One-Time password " . $otp_val." to verify your mobile number on bento.";
//            $message = urlencode($message);
//            $type = "txt";
//            $ch = curl_init("http://smshorizon.co.in/api/sendsms.php?user=" . $username . "&apikey=" . $apikey . "&mobile=" . $mobile . "&senderid=" . $senderid . "&message=" . $message . "&type=" . $type . "");
//            curl_setopt($ch, CURLOPT_HEADER, 0);
//            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//            $output = curl_exec($ch);
//            curl_close($ch);

            $username = "sujitmagdum";
            $pass = "9130002835";
            $message = "Please enter your One-Time password " . $otp_val . " to verify your mobile number on bento.";
            $sender = "INVITE"; //ex:INVITE
            $mobile_number = $phone;
            $url = "login.bulksmsgateway.in/sendmessage.php?user=" . urlencode($username) . "&password=" . urlencode($pass) . "&mobile=" . urlencode($mobile_number) . "&message=" . urlencode($message) . "&sender=" . urlencode($sender) . "&type=" . urlencode('3');
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $output = curl_exec($ch);
            curl_close($ch);


            Log::info($output);

            //return $output;

            $output = json_decode($output, true);

            if ($output['status'] == 'success') {
                $data['user_id']=$user->id;
                $data['phone']=$user->phone;
                $data['password']=$password;
                DB::commit();
                return Utility::genSuccessResp('signup_success', $data);
            } else {
                DB::rollback();
                return Utility::genErrResp('signup_error');
            }
        } catch (Exception $ex) {
            DB::rollback();
            Utility::logException($ex);
            return Utility::genErrResp("internal_err");
        }
    }

    public function logIn(Request $request) {
        try {
            $credentials['phone'] = Input::get('phone');
            $credentials['password'] = Input::get('password');
            //$credentials['is_active'] = 'y';
            if (!$token = JWTAuth::attempt($credentials)) {
                return Utility::genErrResp('auth_error');
            }
            $return_data['token'] = $token;
            return Utility::genSuccessResp('auth_success', $return_data);
        } catch (JWTException $ex) {
            Utility::logException($ex);
            return json_encode(Utility::genErrResp("internal_err"));
        }
    }

    public function isLoggedIn() {
        try {
            $user = JWTAuth::parseToken()->authenticate();
            $token = JWTAuth::fromUser($user);
            $return_data['token'] = $token;
            $return_data['user_name'] = $user['name'];
            $return_data['user_phone'] = $user['phone'];
            return Utility::genSuccessResp('auth_success', $return_data);
        } catch (Exception $ex) {
            Utility::logException($ex);
            return Utility::genErrResp('expired_token');
        }
    }

    public function logout(Request $request) {
        try {
            $token = JWTAuth::getToken();
            if ($token) {
                JWTAuth::setToken($token)->invalidate();
            }
            return Utility::genSuccessResp('logout_success', null);
        } catch (Exception $ex) {
            Utility::logException($ex);
            return Utility::genErrResp("internal_err");
        }
    }

    public function otpVerification(Request $request) {
        try {
            DB::beginTransaction();
            $otp = Input::get('otp');
            $user_id = Input::get('user_id');
            $phone = Input::get('phone');
            $password = Input::get('password');
            $check_otp = Otp::where('otp', $otp)
                    ->where('user_id', $user_id)
                    ->where('status', '=', 'p')
                    ->count();
            if ($check_otp == 1) {
                $otp_update = Otp::where('user_id', $user_id)
                        ->update(array("status" => 'a'));

                $user_update = User::where('id', $user_id)
                        ->update(array("is_active" => 'y'));

                $credentials['phone'] = $phone;
                $credentials['password'] = $password;
                $credentials['is_active'] = 'y';
                if (!$token = JWTAuth::attempt($credentials)) {
                    return Utility::genErrResp('auth_error');
                }
                $return_data['token'] = $token;
                DB::commit();
                return Utility::genSuccessResp('auth_success', $return_data);
            }
            return Utility::genErrResp('invalid_otp', null);
        } catch (JWTException $ex) {
            DB::rollback();
            Utility::logException($ex);
            return Utility::genErrResp("internal_err");
        }
    }

}
