<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\FaqModel;
use Session;
use Hash;
use Validator;

class FaqController extends Controller
{
    public function faq_list(Request  $request)
	{
		$faq_list = FaqModel::orderBy('id','desc')->get();
		return view('admin.faq_list',compact('faq_list'));
	}

	public function addfaq(Request $request) {
		$rules = [
			'question' => ['required'],
			'answer' => ['required']
		];
    
		$validator = Validator::make($request->all(),$rules);
		if($validator->fails()) {
			$output['validation'] = $validator->errors();
			$output['status'] = 0;
		} else {

			$insert['question'] = $request->question;
			$insert['answer'] = $request->answer;
		
			$run = FaqModel::insert($insert);

			if($run){
				$output['status']=1;
				Session::flash('message', '<div class="alert alert-success">Faq has been added successfully.</div>'); 
			}else{
				$output['status']=0;
				Session::flash('error', '<div class="alert alert-danger">Something went wrong.</div>');
			}
		}
		echo json_encode($output);
	}

	public function editfaq(Request $request) {
		$rules = [
			'question' => ['required'],
			/*'answer' => ['required'],*/
			'id' => ['required']
		];
    
		$validator = Validator::make($request->all(),$rules);
		if($validator->fails()) {
			$output['validation'] = $validator->errors();
			$output['status'] = 0;
		} else {
			$update['question'] = $request->question;
			$update['answer'] = $request->answer;
		
			$run = FaqModel::where('id',$request->id)->update($update);

			if($run){
				$output['status']=1;
				Session::flash('message', '<div class="alert alert-success">Faq has been updated successfully.</div>'); 
			}else{
				$output['status']=0;
				Session::flash('error', '<div class="alert alert-danger">Something went wrong.</div>');
			}
		}
		echo json_encode($output);
	}

	public function deletefaq(Request $request) {
		$rules = [
			'id' => ['required']
		];
    
			$id = $request->id;
		
			$run = FaqModel::where(['id'=>$id])->delete();

			if($run){
				$json['status']=1;
				Session::flash('message', '<div class="alert alert-success">Occupation has been deleted successfully.</div>'); 
			}else{
				$json['status']=0;
				Session::flash('error', '<div class="alert alert-danger">Something went wrong.</div>');
			}
		
		return back()->with('message','<div class="alert alert-success">Faq has been deleted successfully</div>');
	}
}
