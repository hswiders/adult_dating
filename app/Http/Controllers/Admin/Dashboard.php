<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\User;
use URL;
use Validator;
use Illuminate\Support\Facades\Hash;

class Dashboard extends Controller
{
    public function index() {
    	//dd('hello dashboard');
    	return view('admin.dashboard');
    }
    public function profile()
    {
        return view('admin.profile');
    }

    public function update_profile(Request $request) {
			$rules = [
				'name' => ['required', 'min:3'],
				'email' => ['required', 'email'],
				'phone' => ['required', 'max:10','min:10'],
			];
    
			$validator = Validator::make($request->all(),$rules);
			if($validator->fails()) {
				$json['validation'] = $validator->errors();
				$json['status'] = 0;
			} else {
				$update['name'] = $request->name;
				$update ['phone']= $request->phone;
					
				if(Auth::guard('admin')->user()->id==1){
					$update['email']=$request->email;
				}
    
				$run = Admin::where(['id'=>Auth::guard('admin')->user()->id])->update($update);

				if($run){
					$json['status']=1;
					Session::flash('success', 'Profile has been updated successfully'); 
				}else{
					$json['status']=0;
					Session::flash('error', "Something went wrong.");
				}
			}
			echo json_encode($json);
    }

    public function update_user_profile(Request $request) {

            $rules = [
                'first_name' => ['required', 'min:3'],
                'last_name' => ['required', 'min:3'],
                'username' => ['required', 'min:3'],
                'dob' => ['required'],
                'height' => ['required'],
                'occupation' => ['required'],
                'country' => ['required', 'min:3'],
                'city' => ['required', 'min:3'],
                'spoken_language' => ['required'],
                'display_language' => ['required'],
                'education' => ['required'],
                'is_smoker' => ['required'],
                'marital_status' => ['required'],
                'have_children' => ['required'],
                'have_tatto' => ['required'],
                'gender' => ['required'],
                'nationality' => ['required'],
               
            ];
    
            $validator = Validator::make($request->all(),$rules);
            if($validator->fails()) {
                $json['validation'] = $validator->errors();
                $json['status'] = 0;
            } else {
                $update['first_name'] = $request->first_name;
                $update['last_name'] = $request->last_name;
                $update['username'] = $request->username;
                $update['dob'] = $request->dob;
                if(!empty($request->dob)){
                    $update['dob_d'] = date('d', strtotime($request->dob));
                    $update['dob_m'] = date('m', strtotime($request->dob));
                    $update['dob_y'] = date('Y', strtotime($request->dob));
                }
                $update['height'] = $request->height;
                $update['occupation'] = $request->occupation;
                $update['country'] = $request->country;
                $update['city'] = $request->city;
                $update['spoken_language'] = $request->spoken_language;
                $update['display_language'] = $request->display_language;
                $update['education'] = $request->education;
                $update['is_smoker'] = $request->is_smoker;
                $update['marital_status'] = $request->marital_status;
                $update['have_children'] = $request->have_children;
                $update ['have_tatto']= $request->have_tatto;
                $update ['gender']= $request->gender;
                $update ['nationality']= $request->nationality;
                if(!empty($_FILES['image']['name'])){
                    $imageName = time().'.'.$request->image->extension();
                    $request->image->move(public_path('uploads/'), $imageName);
                    $update['image']='/uploads/'.$imageName;
                }

                $run = User::where(['id'=>$request->id])->update($update);
                if($run){
                    $json['status']=1;
                    Session::flash('success', 'Profile has been updated successfully'); 
                }else{
                    $json['status']=0;
                    Session::flash('error', "Something went wrong.");
                }
            }
            echo json_encode($json);
    }


    public function change_password(Request $request)
    {
        $rules = [
            'old_pass'=>'required|min:6',
            'new_pass'=>'required|min:6',
            'cnew_pass' => 'required|min:6|max:25|required_with:new_pass|same:new_pass',
        ];
    
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()) {
            $json['validation'] = $validator->errors();
            $json['status'] = 00;
        } else {
            if(Hash::check($request->old_pass, Auth::guard('admin')->user()->password)){
                $run = Admin::where(['id'=>Auth::guard('admin')->user()->id])->update(['password'=>Hash::make($request->new_pass)]);
                
                if($run){
                    $json['status']=1;
                    Session::flash('success', 'Password has been updated successfully'); 
                }else{
                    $json['status']=000;
                    Session::flash('error', "Something went wrong, Might be this profile doesn't exists.");
                }
            }else{
                $json['status']=0000;
                $json['message'] = "<div class='alert alert-danger'>Your old password doesn't match!!...</div>";
            }
        }
        echo json_encode($json);
    }
}
