<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang as Lang;
use Validator;
class UsersController extends Controller
{
    //
    public function login()
    {

        return view('auth.webLogin');
    }

    public function saveLogin(Request $request)
    {

        $input = $request->all();

        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ], [
            'email.required' => "Email Field Is Required",
            'password.required' => "Password Field Is Required",

        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput()
            ->withErrors(Lang::get('links.invalid_msg'));


        }



        if (auth()->attempt(array('email' => $input['email'], 'password' => $input['password']))) {

            if (auth()->user()->user_type == 1) {
                return redirect('/');
            } else {
                return redirect()->route('user-login')
                ->withErrors("Invalied Email Or Password");
            }


        } else {

            return redirect()->route('user-login')
                ->withErrors("Invalied Email Or Password");

        }

    }

    public function registerUser(Request $request)
    {
        $input = $request->all();

        // $validator = Validator::make($request->all(), [
        //     'f_name' => ['required', 'string', 'max:255'],
        //     'l_name' => ['required', 'string', 'max:255'],
        //     'username' => ['required', 'string', 'max:255'],
        //     'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        //     'phone' => ['required', 'string', 'max:255', 'unique:users'],

        //     'password' => ['required', 'string', 'min:8', 'confirmed'],
        // ]);

        // if ($validator->fails()) {
        //     $error = $validator->errors()->first();
        //     dd($error);


        // }

        $user=User::create([
            'f_name' => $input['f_name'],
            'l_name' => $input['l_name'],
            'username' => $input['username'],
            'email' => $input['email'],
            'phone' => $input['phone'],

            'password' => Hash::make($input['password']),
        ]);
        $user->assignRole(1);


        if (auth()->attempt(array('email' => $input['email'], 'password' => $input['password']))) {


                return redirect('/');



        } else {

            return redirect()->route('user-login')
                ->withErrors("Invalied Email Or Password");

        }

    }
}
