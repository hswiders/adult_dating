<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\OccupationModel;
use Session;
use Hash;
use Validator;

class OccupationController extends Controller
{
	public function occupation(Request  $request)
	{
		$occupation = OccupationModel::orderBy('id','desc')->get();
		return view('admin.occupation_list',compact('occupation'));
	}

	public function addOccupationForm()
	{
		return view('admin.add_occupation');
	}

	public function addOccupation(Request $request) {
		$rules = [
			'title' => ['required']
		];
    
		$validator = Validator::make($request->all(),$rules);
		if($validator->fails()) {
			$json['validation'] = $validator->errors();
			$json['status'] = 0;
		} else {
			$insert['title'] = $request->title;
			$insert['created_at'] = date('Y-m-d H:i:s');
			
			$run = OccupationModel::insert($insert);

			if($run){
				$json['status']=1;
				Session::flash('message', '<div class="alert alert-success">Occupation has been added successfully.</div>'); 
			}else{
				$json['status']=0;
				Session::flash('error', '<div class="alert alert-danger">Something went wrong.</div>');
			}
		}
		echo json_encode($json);
	}

	public function editOccupationForm(Request $request)
	{
		$occupation = OccupationModel::where('id',$request->id)->first();
		return view('admin.edit_occupation',compact('occupation'));
	}

	public function editOccupation(Request $request) {
		//dd('edit occupation');
		$rules = [
			'title' => ['required'],
			'id' => ['required']
		];
    
		$validator = Validator::make($request->all(),$rules);
		if($validator->fails()) {
			$json['validation'] = $validator->errors();
			$json['status'] = 0;
		} else {
			$update['title'] = $request->title;
			$update['updated_at'] = date('Y-m-d H:i:s');
			$run = OccupationModel::where('id',$request->id)->update($update);

			if($run){
				$json['status']=1;
				Session::flash('message', '<div class="alert alert-success">Occupation has been updated successfully.</div>'); 
			}else{
				$json['status']=0;
				Session::flash('error', '<div class="alert alert-danger">Something went wrong.</div>');
			}
		}
		echo json_encode($json);
	}

	public function deleteOccupation(Request $request) {
		$rules = [
			'id' => ['required']
		];
    
			$id = $request->id;
		
			$run = OccupationModel::where(['id'=>$id])->delete();

			if($run){
				$json['status']=1;
				Session::flash('message', '<div class="alert alert-success">Occupation has been deleted successfully.</div>'); 
			}else{
				$json['status']=0;
				Session::flash('error', '<div class="alert alert-danger">Something went wrong.</div>');
			}
		
		return back()->with('message','<div class="alert alert-success">Occupation has been deleted successfully</div>');
	}
}
