<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;
use Session;
use Hash;
use Validator;
use Auth;

class LoginController extends Controller
{
    public function login(){
   	 return view('front.login');
    }
  

     public function do_login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $output['status'] = 'success';
            
            Session::flash('success' , 'Logged In successfully');

            $output['redirect'] = route('user-dashboard');
            return json_encode($output);
        }
  
        $output['status'] = 'error';
        $output['message'] = 'Invalid Login';
        return json_encode($output);
    }
}
