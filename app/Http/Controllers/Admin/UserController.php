<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\OccupationModel;
use App\Models\nationalityModel;
use App\Models\LanguageModel;
use App\Models\EducationModel;

use Session;
use Hash;
use Validator;

class UserController extends Controller
{
	public function index(Request  $request){
		$user = User::orderBy('id','desc')->get();
		return view('admin.user_list',compact('user'));
	}


	public function change_status(Request  $request){
		$id = $request->id;
		$status = $update['status'] = $request->status;

		if($status == 1){
			$msg = 'active';
		}else{
			$msg = 'blocked';
		}

		$run = User::where('id',$request->id)->update($update);

			if($run){
				$output['status']=1;
				Session::flash('message', '<div class="alert alert-success">Users has been '.$msg.' successfully.</div>'); 
			}else{
				$output['status']=0;
				Session::flash('error', '<div class="alert alert-danger">Something went wrong.</div>');
			}
		echo json_encode($output);
	}

	public function edit_user(Request $request) {
		$user = User::where('id', $request->id)->take(1)->first();
		$occupation = OccupationModel::where('status', 0)->orderBy('title', 'asc')->get();
		$nationality = nationalityModel::orderBy('title', 'asc')->get();
		$language = LanguageModel::orderBy('title', 'asc')->get();
		$education = EducationModel::orderBy('title', 'asc')->get();
		return view('admin.edit-user', compact('user', 'occupation', 'nationality', 'language', 'education'));
	}

	public function deleteUser(Request $request) {
		$rules = [
			'id' => ['required']
		];
    
			$id = $request->id;
		
			$run = User::where(['id'=>$id])->delete();

			if($run){
				$json['status']=1;
				Session::flash('message', '<div class="alert alert-success">User has been deleted successfully.</div>'); 
			}else{
				$json['status']=0;
				Session::flash('error', '<div class="alert alert-danger">Something went wrong.</div>');
			}
		
		return back()->with('message','<div class="alert alert-success">User has been deleted successfully</div>');
	}
}
