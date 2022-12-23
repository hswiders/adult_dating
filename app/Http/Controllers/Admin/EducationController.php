<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\EducationModel;
use Session;
use Hash;
use Validator;

class EducationController extends Controller
{
	public function index(Request  $request)
	{
		$education = EducationModel::orderBy('id','desc')->get();
		return view('admin.education-list',compact('education'));
	}

	

	public function addEducation(Request $request) {
		$rules = [
			'title' => ['required']
		];
    
		$validator = Validator::make($request->all(),$rules);
		if($validator->fails()) {
			Session::flash('error', '<div class="alert alert-danger">Language title has been required</div>');
			$json['status'] = 0;
			echo json_encode($json); exit();
		} else {
			
			$insert['title'] = $request->title;
			$run = EducationModel::insert($insert);

			if($run){
				$json['status']=1;
				Session::flash('message', '<div class="alert alert-success">Education has been inserted successfully.</div>'); 
			}else{
				$json['status']=0;
				Session::flash('error', '<div class="alert alert-danger">Something went wrong.</div>');
			}
		}
		echo json_encode($json);
	}


	public function updateEducation(Request $request) {
		$rules = [
			'title' => ['required'],
			'id' => ['required']
		];
    
		$validator = Validator::make($request->all(),$rules);
		if($validator->fails()) {
			Session::flash('message', '<div class="alert alert-danger">Education title has been required</div>');
			$json['status'] = 0;
			echo json_encode($json); exit();
		} else {
			$check = EducationModel::where('id', '!=', $request->id)->where('title', $request->title)->take(1)->first();
			if(!blank($check)){
				Session::flash('message', '<div class="alert alert-danger">Education title has been already exit..</div>');
				$json['status'] = 0;
				echo json_encode($json); exit();
			}
			$update['title'] = $request->title;
			$update['updated_at'] = date('Y-m-d H:i:s');
			$run = EducationModel::where('id',$request->id)->update($update);

			if($run){
				$json['status']=1;
				Session::flash('message', '<div class="alert alert-success">Education has been updated successfully.</div>'); 
			}else{
				$json['status']=0;
				Session::flash('message', '<div class="alert alert-danger">Something went wrong.</div>');
			}
		}
		echo json_encode($json);
	}

	public function deleteEducation(Request $request) {
		$rules = [
			'id' => ['required']
		];
    
			$id = $request->id;
		
			$run = EducationModel::where(['id'=>$id])->delete();

			if($run){
				$json['status']=1;
				Session::flash('message', '<div class="alert alert-success">Education has been deleted successfully.</div>'); 
			}else{
				$json['status']=0;
				Session::flash('error', '<div class="alert alert-danger">Something went wrong.</div>');
			}
		
		return back()->with('message','<div class="alert alert-success">Education has been deleted successfully</div>');
	}
}
