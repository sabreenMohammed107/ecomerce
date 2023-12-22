<?php

namespace App\Http\Controllers\Api;

use App\Models\Device;
use App\Http\Controllers\Api\BaseController;
use App\Models\Helper;
use App\Models\User;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Validator;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Hash;
use App\Mail\ResetPassword;
use Illuminate\Support\Facades\Mail;

class AuthController extends BaseController
{
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        if($validator->fails()){
            return $this->convertErrorsToString($validator->messages());
        }

        try
        {
            $input = $request->all();
            $input['password'] = bcrypt($input['password']);
            $input['user_type']=1;
            $user = User::create($input);
            $user->accessToken =  $user->createToken('MyApp')->accessToken;

            //send sms

            // $data['mobile'] = 201117615935;
            // $data['msg'] = 'تم التفعيل';
            // $sms = Helper::send_sms($data);
// $user->smsResponse=$sms;

            return $this->sendResponse($user, 'User has been registed');

        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 'Error happens!!');
        }
    }

    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
            // 'device_token' =>'required',
        ]);

        if ($validator->fails()) {
            return $this->convertErrorsToString($validator->messages());
        }

        try
        {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                $user = Auth::user();
                $user->accessToken = $user->createToken('MyApp')->accessToken;
//devices
// $device = Device::where('token','=', $request->device_token)->first(); //laravel returns an integer
// $data=[
//     'token'=> $request->device_token,
//     'user_id'=>$user->id,
//     'status'=>1,
// ];
// if($device) {
//     $device->update($data);

// } else {
//     Device::create($data);
// }
                return $this->sendResponse($user, 'User login successfully.');
            } else {
                return $this->sendError('Invalid Useremail or Password!');
            }
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 'Error happens!!');
        }
    }


    public function tokenUpdate(Request $request){
        $validator = Validator::make($request->all(), [
            'token' => 'required',


        ]);

        if ($validator->fails()) {
            return $this->convertErrorsToString($validator->messages());
        }

        try
        {
            $user = Auth::user();
            if ($user) {
                $device = Device::where('token','=', $request->token)->first(); //laravel returns an integer
                $data=[
                    'token'=> $request->token,
                    'user_id'=>$user->id,
                    'status'=>1,

                ];
                if($device) {
                    $device->update($data);

                } else {
                    Device::create($data);
                }
                return $this->sendResponse(null, 'your token update succesfully.');

            }


    } catch (\Exception $e) {
        return $this->sendError($e->getMessage(), 'Error happens!!');
    }
    }
    /**
     * logout api
     *
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        try
        {
            $token = $request->user()->token();
            $token->revoke();

            return $this->sendResponse(null, 'You have been successfully logged out!');
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 'You don\'\t Login');
        }
    }
    /**
     * forgot api
     *
     * @return \Illuminate\Http\Response
     */

    // public function forgot()
    // {

    //     // $credentials = request()->validate(['email' => 'required|email']);
    //     // dd($credentials);
    //     $user = User::where('email', request()->input('email'))->first();
    //     $token = Password::getRepository()->create($user);

    //     // Password::sendResetLink($credentials);
    //     \Mail::send(['text' => 'emails.password'], ['token' =>$token], function (Message $message) use ($user) {
    //         $message->subject(config('app.name') . ' Password Reset Link');
    //         $message->to($user->email);
    //     });

    //     return response()->json(["msg" => 'Reset password link sent on your email id.']);
    // }

    // public function reset(Request $request)
    // {

    //     $credentials = request()->validate([
    //         'email' => 'required|email',
    //         // 'token' => 'required|string',
    //         'password' => 'required|string',
    //     ]);
    //   $user=User::where('email',$request->email) ->first();
    //     // $token ="eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiMWViNTY1OTExYjU2NjZhZTBkZGU0NGU3Mjg1YzcyY2MxYTgyYTQ1MjhjNDNhYzM3YmQ4OTNkMzAzZGI1MTJiODk1Y2E2MmY3YjdmN2JlMmUiLCJpYXQiOjE2Mjk4NDQ5OTYsIm5iZiI6MTYyOTg0NDk5NiwiZXhwIjoxNjYxMzgwOTk2LCJzdWIiOiIzIiwic2NvcGVzIjpbXX0.WrpwszDMPU-RP2q1D4hO4ps0aSmJiEn_9LI7vfoWmoOZdUHvBf8zUy19Q3o37bw1Yc3Dqk6NNAmVUh82pvUv0wq1WhbKE7FD67AxTkDz9rEZGQPM-5aSm0nsytj7O3SP7OccBME9nlSH8FwsVPhQLGUoJevc3z_uuCvw_w0P7NEEP7NSW_uwp6-7PBPJFOjt8WPmUX8u9ZIE8_eJNpOTPXFXzSVLhB_zmF2nz-laiDQF_c3f3oC0byf1X8D68FT3PjtrNR2YvU7X2D_E4uaTNCZQW4KW5oDaFdCnx8mgzWPLeMFH4xDRayXXSXRHAKnnJaY3iZOuq768Rkd_WIS6eAKHEJOjthxADYEf02jrQLOjwLbtldMfTi41E25uXJ4LUaspMGz41jtUpRvw0vWLqhFUlOg9mQQsZNzyX21eFQ5PWxGkUgCjT7Yo89thUt8ncznXZWIrQBkno3C5axuBzOMZsC598_LhvwkdlQqcv2W24Qy9iNgdpmovTWmD1uL2xdUgrizH_-jDHJoP4DJLnJ1wyhY64zRXDst25jSIgE3wqnGHVtwvTiPK2BxqZ67kNKrctDuY8Biz8NBvK6a09AF7u6WR02N3S-JHMfbtbuy88qBb-s4nj-rj8g8h5Yok8sGTuUfUoenMK4wV7Sx9VJ4PEkAjeNRhgBxQfvGKhBg";
    //     $data = [
    //         'email' => $request->email,
    //         // 'token' => $token,
    //         'password' => $request->password
    //     ];

    //     // $reset_password_status = Password::reset($credentials, function ($user, $password) {
    //         $user->password =bcrypt($request->password);
    //         $user->save();
    //     // });

    //     // if ($reset_password_status == Password::INVALID_TOKEN) {
    //     //     return response()->json(["msg" => "Invalid token provided"], 400);
    //     // }

    //     return response()->json(["msg" => "Password has been successfully changed"]);
    // }


    public function forgot_password(Request $request)
{
    $input = $request->all();
    $rules = array(
        'email' => "required|email",
    );
    $validator = Validator::make($input, $rules);
    if ($validator->fails()) {
        return $this->convertErrorsToString($validator->messages());
    } else {
        // try {
            // $response = Password::sendResetLink($request->only('email'), function (Message $message) {
            //     $message->subject($this->getEmailSubject());
            // });
            // return $this->sendResponse($response, 'User has been send mail');
            $user=User::where('email',$request->email)->first();

            Mail::to($request->email)->send(new ResetPassword($user->name, $user->id));

            if(Mail::failures() != 0) {
                return $this->sendResponse($user, 'User has been send mail');
            }
            return $this->sendResponse(null, 'Failed! there is some issue with email provider');

        // } catch (\Exception $e) {
        //     return $this->sendError($e->getMessage(), 'Error happens!!');
        // }
    }
      return $this->sendResponse(null, 'User has been send mail');
}

public function change_password(Request $request)
{
    $input = $request->all();
    $userid = Auth::user()->id;
    $rules = array(
        'old_password' => 'required',
        'new_password' => 'required|min:6',
        'confirm_password' => 'required|same:new_password',
    );
    $validator = Validator::make($input, $rules);
    if ($validator->fails()) {
        return $this->convertErrorsToString($validator->messages());
    } else {
        try {
            if ((Hash::check(request('old_password'), Auth::user()->password)) == false) {
                $arr = array("status" => true, "message" => "Check your old password.");
                // return $this->sendResponse(null, 'You have been successfully logged out!');
            } else if ((Hash::check(request('new_password'), Auth::user()->password)) == true) {
                $arr = array("status" => true, "message" => "Please enter a password which is not similar then current password.", "data" => array());
            } else {
                User::where('id', $userid)->update(['password' => Hash::make($input['new_password'])]);
                $arr = array("status" => true, "message" => "Password updated successfully.");
            }
        } catch (\Exception $ex) {
            if (isset($ex->errorInfo[2])) {
                $msg = $ex->errorInfo[2];
            } else {
                $msg = $ex->getMessage();
            }
            $arr = array("status" => false, "message" => $msg);
        }
    }
    // return \Response::json($arr);
    return $this->sendResponse($arr, 'User has been change_password');
}

public function Profile($id){
    try
    {
        $user = User::where('id','=', $id)->first();
        if ($user) {

            return $this->sendResponse($user, 'User Profile.');
        } else {
            return $this->sendError('Invalid User!');
        }
    } catch (\Exception $e) {
        return $this->sendError($e->getMessage(), 'Error happens!!');
    }
}
}
