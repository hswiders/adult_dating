<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\OccupationModel;
use Session;
use Hash;
use Mail;
use Auth;
use Validator;
use Carbon\Carbon; 
use Str;
use DB;
class RegisterController extends Controller
{
   
   public function signup()
   {
   	 $data['occupation'] = OccupationModel::get();
   	 return view('front.registration' , $data);
   }

	public function register(Request $request) {
   	$this->validate($request,[
         'first_name'=>'required',
         'last_name'=>'required',
         'occupation'=>'required',
         'username'=>'required|alpha_dash |regex:/(^[a-zA-Z]+[a-zA-Z0-9\\-]*$)/u|max:255|unique:users,username',
         'city'=>'required',
         'country'=>'required',
         'gender'=>'required',
         'email'=>'required|email|unique:users',
         'password'=> 'required|min:6',
         'cpassword'=>'required_with:password|same:password|min:6',
         
        ]);

         
         $age = date('Y') - $request->dob_y;
         
         if($age < 18){
           return json_encode(['status'=>'error','message'=>'Your age should be above 18 year']);
         }

        try {
            
            $user = new User;
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->dob_d = $request->dob_d;
            $user->dob_m = $request->dob_m;
            $user->dob_y = $request->dob_y;
            $user->age = date('Y') - $request->dob_y;
            $user->city = $request->city;
            $user->gender = $request->gender;
            $user->username = $request->username;
            $user->country = $request->country;
            $user->occupation = $request->occupation;
            $user->password = Hash::make($request->password);
            $user->created_at = date('Y-m-d H:i:s');
            
            $user->updated_at = date('Y-m-d H:i:s');
            
            $user->save();
            if($user)
            {
            	$body = '<p>Hello ' . $request->first_name. '</p>,';
 					$body .= '<p >Thanks for registering with ' . env('APP_NAME') . '! </p>';
               Mail::send('emails.custom', ['data' => $body], function($message) use($request){
              		$message->to($request->email);
              		$message->subject('Welcome to ' . env('APP_NAME') );
          		});
          		Auth::loginUsingId($user->id);

            }
            $output['status'] = 'success';
            
            Session::flash('success' , 'Registered successfully');
            $output['redirect'] = route('user-dashboard');
        } catch (Exception $e) {
            $output['status'] = 'error';
            $output['message'] = $e;
        }
        
        return json_encode($output);
	}
    function forgotView()
    {
        return view("front.forgot");
    }
    function doForgot(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',   // required and email format validation

        ]); // create the validations
        if ($validator->fails())   //check all validations are fine, if not then redirect and show error messages
        {
            return response()->json($validator->errors(),422);  
            // validation failed return with 422 status

        } else {
            //validations are passed try login using laravel auth attemp
            $email = $request->email;
            $check = User::select('email')->where('email', $email)->first();
            if ($check) {

                /*Email code goes here*/
                 $token = Str::random(64);
  
                  DB::table('password_resets')->insert([
                      'email' => $request->email, 
                      'token' => $token, 
                      'created_at' => Carbon::now()
                    ]);
                $body = '<h1>Forget Password Email</h1>You can reset password from bellow link:<a href="'. route('reset.password.get', $token) .'">Reset Password</a>';
                Mail::send('emails.custom', ['data' => $body], function($message) use($request){
              $message->to($request->email);
              $message->subject('Reset Password');
          });
                return response()->json(["status"=>true,"msg"=>'We have sent you an reset link ',"redirect_location"=>route("forgot-password")]);
                
            } else {
                return response()->json(["email" => array('This email is not registered with us')],422);
                
            }
        }
    }
    public function showResetPasswordForm($token) { 
         return view('front.forgotLink', ['token' => $token]);
      }
  
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function submitResetPasswordForm(Request $request)
      {
          $request->validate([
              'email' => 'required|email|exists:users',
              'password' => 'required|string|min:6|confirmed',
              'password_confirmation' => 'required'
          ]);
  
          $updatePassword = DB::table('password_resets')
                              ->where([
                                'email' => $request->email, 
                                'token' => $request->token
                              ])
                              ->first();
  
          if(!$updatePassword){
              return back()->withInput()->with('error', 'Invalid token!');
          }
  
          $user = User::where('email', $request->email)
                      ->update(['password' => Hash::make($request->password)]);
 
          DB::table('password_resets')->where(['email'=> $request->email])->delete();
  
          return redirect('/signin')->with('success', 'Your password has been changed!');
      }
}
