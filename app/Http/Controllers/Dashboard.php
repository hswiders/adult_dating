<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use URL;
use Validator;
use Session;
use Auth;
use App\Models\OccupationModel;
use App\Models\User;
use App\Models\LanguageModel;
use App\Models\nationalityModel;
use App\Models\EducationModel;
use App\Models\UserPhotos;
use App\Models\WinkUsers;
use App\Models\PinUsers;
use App\Models\ViewedUsers;
use Illuminate\Support\Facades\Hash;
use DB;
class Dashboard extends Controller
{
	public function index() {
        $user = auth()->user();
        $data['close_to_you'] = User::where('city' , $user->city)->where('id' ,'!=', $user->id)->take(4)->get();
        $data['online_user'] = User::where('online_status', '=', 1)->where('id' ,'!=', $user->id)->where(function ($query) 
        {
            $user = auth()->user();
            $query->where('city' , $user->city)->orWhere('country' , $user->country);
        })->take(4)->get();
        $user->online_status = 1;
        $user->save();
    	return view('front.users.dashboard' , $data);
    }

    public function profileDashboard() {
        $user = auth()->user();
        $data['kisses'] = WinkUsers::where('wink_by' , $user->id)->get()->count();
        $data['kisses_received'] = WinkUsers::where('wink_to' , $user->id)->get()->count();
        $contact = WinkUsers::where('wink_to' , $user->id)->first();
        $data['contact'] = User::where('id',$contact->wink_by)->first();
        $data['contact_wink'] = DB::table('users')
                ->join('wink_users','users.id', '=', 'wink_users.wink_to')
                ->whereRaw('wink_users.wink_by = '.$user->id)->whereRaw('users.id NOT IN( select blocked_to from blocked_users where blocked_by = '.$user->id.' )')->select('users.*')
                ->get();
           
        $data['pins'] = PinUsers::where('pin_to', $user->id)->get()->count();
        $data['pins_by'] = PinUsers::where('pin_by', $user->id)->get()->count();
        $data['viewed_by'] = ViewedUsers::where('viewed_by', $user->id)->get()->count();
        $data['viewed_to'] = ViewedUsers::where('viewed_to', $user->id)->get()->count();
        return view('front.users.profile_dashboard' , $data);
    }

    public function userList($type) {
        $user = auth()->user();
        
        if ($type == 'online') {
            $data['members'] = User::where('online_status', '=', 1)->where(function ($query) 
            {
                $user = auth()->user();
                $query->where('city' , $user->city)->orWhere('country' , $user->country);
            })->where('id' ,'!=', $user->id)->get();
            $data['title'] = 'Online Now';
            $data['page_type'] = 'is_online';
            $data['sub_title'] = 'Is Online';

        }
        elseif($type == 'close')
        {
             $data['members'] = User::where('city' , $user->city)->where('id' ,'!=', $user->id)->get();
             $data['title'] = 'Close to you';
             $data['page_type'] = 'city';
             $data['sub_title'] = 'Girls whom you like and are located close to you';
        }
       elseif($type == 'country')
        {
             $data['members'] = User::where('country' , $user->country)->where('id' ,'!=', $user->id)->get();
              $data['title'] = 'New Аrrivals';
              $data['page_type'] = 'country';
            $data['sub_title'] = 'New girls have just arrived, check them out! Hurry up & take your chance!';
        }
       elseif($type == 'all')
        {
             $data['members'] = User::where('id' ,'!=', $user->id)->get();
              $data['title'] = 'New Аrrivals';
              $data['page_type'] = 'all';
            $data['sub_title'] = 'New girls have just arrived, check them out! Hurry up & take your chance!';
        }
       
        return view('front.users.user-list' , $data);
    }

    public function profile() {
    	$data['occupation'] = OccupationModel::get();
    	$data['languages'] = LanguageModel::get();
        $data['nationality'] = nationalityModel::get();
    	$data['education'] = EducationModel::get();
    	return view('front.users.profile' , $data);
    }
   
    public function UpdateProfile(Request $request) {
   	$this->validate($request,[
         'occupation'=>'required',
         'city'=>'required',
         'country'=>'required',
        ]);
        try {
            
            $user = auth()->user();
            $getuserdetail=User::where('username',$request->username)->where('id','!=',$user->id)->first();
            if(isset($getuserdetail->id)){
                return json_encode(['status'=>'error','message'=>'Username already exists','errorid'=>'usernameerror']);
            }elseif(isset($request->passwordusername) &&  !empty($request->passwordusername) && !Hash::check($request->passwordusername, $user->password)){
                return json_encode(['status'=>'error','message'=>'Invalid Password','errorid'=>'passwordusernameerror']);
            }
            if (isset($request->old_password) &&  !empty($request->old_password) && !Hash::check($request->old_password, $user->password)) {
                return json_encode(['status'=>'error','message'=>'Old Password is not correct','errorid'=>'old_passworderror']);
            }
            $user->dob_d = $request->dob_d;
            $user->dob_m = $request->dob_m;
            $user->dob_y = $request->dob_y;
            $user->age = date('Y') - $request->dob_y;
            $user->city = $request->city;
            if(isset($request->spoken_language))
            {
            	$user->spoken_language = implode(',', $request->spoken_language);
            }
            if(isset($request->height))
            {
            	$user->height = $request->height;
            }
            if(isset($request->nationality))
            {
            	$user->nationality = $request->nationality;
            }
            if(isset($request->have_tatto))
            {
            	$user->have_tatto = $request->have_tatto;
            }
            if(isset($request->is_smoker))
            {
            	$user->is_smoker = $request->is_smoker;
            }
            if(isset($request->marital_status))
            {
            	$user->marital_status = $request->marital_status;
            }
            if(isset($request->have_children))
            {
            	$user->have_children = $request->have_children;
            }
            if(isset($request->education))
            {
                $user->education = $request->education;
            }
            if(isset($request->username))
            {
                $user->username = $request->username;
            }
            if(isset($request->new_password))
            {
                $user->password = Hash::make($request->new_password);
            }

            if($request->hasFile('profileimage')){
                $profileimageName = time().'.'.$request->profileimage->extension();  
                $request->profileimage->move(public_path('users/profileimage'), $profileimageName);
                $user->profileimage = 'users/profileimage/'.$profileimageName;
            }

            if($request->hasFile('coverimage')){
                $imageName = time().'.'.$request->coverimage->extension();  
                $request->coverimage->move(public_path('users/coverimage'), $imageName);
                $user->coverImage = 'users/coverimage/'.$imageName;
            }
            
            $user->country = $request->country;
            $user->occupation = $request->occupation;
            $user->updated_at = date('Y-m-d H:i:s');
            
            $user->save();
            
            $output['status'] = 'success';
            $output['message'] = 'Profile has been updated successfully';
            
            Session::flash('success' , 'Profile has been updated successfully');
            $output['redirect'] = route('user-profile');
        } catch (Exception $e) {
            $output['status'] = 'error';
            $output['message'] = $e;
        }
        
        return json_encode($output);
	}

    public function lookingfor(Request $request){
        $user = auth()->user();
        $user->lookingfor = implode(',',$request->lookingfor);
        $user->save();
        $output['status'] = 'success';
        $output['message'] = 'Profile has been updated successfully';
        return json_encode($output);
    }
    public function mediaUpload(Request $request){
        $image = new UserPhotos;
        $user = auth()->user();
        if($request->hasFile('file')){
                $imageName = time().'.'.$request->file->extension();  
                $request->file->move(public_path('uploads'), $imageName);
                $image->image = 'uploads/'.$imageName;
                $image->image_category = $request->image_category;
                $image->user_id = $user->id;
                $image->save();
                $output['status'] = 'success';
                $output['message'] = 'Image has been Uploaded successfully';
            }
            else
            {
                $output['status'] = 'success';
                $output['message'] = 'Something went wrong';
            }
        
        return json_encode($output);
    }

    public function getPhotoBoxes(Request $request){

        $user = User::find($request->user_id);
        $title = ['' , 'Public Photos' , 'Private Photos' , 'Spicy Photos' , 'Chilly Photos'];
        $data['images'] = UserPhotos::where(['user_id' => $user->id , 'image_category' => $request->image_category])->get();
        $data['image_category'] = $request->image_category;

        $data['title'] = $title[$request->image_category];
           
        $output['html'] = (string)view('front.users.ajax_data.photo_boxes' , $data);
        
        return json_encode($output);
    }
    public function deletePhoto(Request $request){

        $user = auth()->user();
        
         UserPhotos::where(['user_id' => $user->id , 'id' => $request->id])->delete();
        
        $output['status'] = 'success';
        Session::flash('success' , 'Image deleted successfully');
        return json_encode($output);
    }

    public function setProfile(Request $request){

        $user = auth()->user();
        
         $img = UserPhotos::where(['user_id' => $user->id , 'id' => $request->id])->first();
        $user->profileimage = $img->image;
       $user->save();
        $output['status'] = 'success';
        Session::flash('success' , 'Image Updated successfully');
        return json_encode($output);
    }
    public function setCover(Request $request){

            $user = auth()->user();
            
             $img = UserPhotos::where(['user_id' => $user->id , 'id' => $request->id])->first();
            $user->coverImage = $img->image;
           $user->save();
            $output['status'] = 'success';
            Session::flash('success' , 'Image Updated successfully');
            return json_encode($output);
        }

    public function logout() {
        $user = auth()->user();
        $user->online_status = 0;
        $user->save();
        Session::flush();
        Auth::logout();
  		 Session::flash('success' , 'Logged Out successfully');
        return Redirect('/');
    }
}
