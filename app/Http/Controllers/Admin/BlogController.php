<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\BlogModel;
use Session;
use Hash;
use Validator;

class BlogController extends Controller
{
    public function blog_list(Request  $request){
		$blog_list = BlogModel::orderBy('id','desc')->get();
		return view('admin.blog_list',compact('blog_list'));
	}

	public function addblog(Request $request) {
		$rules = [
			'title' => ['required'],
			'description' => ['required']
		];
    
		$validator = Validator::make($request->all(),$rules);
		if($validator->fails()) {
			$output['validation'] = $validator->errors();
			$output['status'] = 0;
		} else {

			$insert['title'] = $request->title;
			$insert['description'] = $request->description;
			$imageName = time().'.'.$request->file->extension();  
            $request->file->move(public_path('admin/blog_image'), $imageName); 
            $insert['image'] =$imageName;
		
			$run = BlogModel::insert($insert);

			if($run){
				$output['status']=1;
				Session::flash('message', '<div class="alert alert-success">Blog has been added successfully.</div>'); 
			}else{
				$output['status']=0;
				Session::flash('error', '<div class="alert alert-danger">Something went wrong.</div>');
			}
		}
		echo json_encode($output);
	}

	public function editblog(Request $request) {
		$rules = [
			'title' => ['required'],
			/*'description' => ['required'],*/
			'id' => ['required']
		];
    
		$validator = Validator::make($request->all(),$rules);
		if($validator->fails()) {
			$output['validation'] = $validator->errors();
			$output['status'] = 0;
		} else {
			$update['title'] = $request->title;
			$update['description'] = $request->description;
			if($request->file){
				$imageName = time().'.'.$request->file->extension();  
            	$request->file->move(public_path('admin/blog_image'), $imageName); 
            	$update['image'] =$imageName;	
			}
			
		
			$run = BlogModel::where('id',$request->id)->update($update);

			if($run){
				$output['status']=1;
				Session::flash('message', '<div class="alert alert-success">Blog has been updated successfully.</div>'); 
			}else{
				$output['status']=0;
				Session::flash('error', '<div class="alert alert-danger">Something went wrong.</div>');
			}
		}
		echo json_encode($output);
	}

	public function deleteblog(Request $request) {
		$rules = [
			'id' => ['required']
		];
    
			$id = $request->id;
		
			$run = BlogModel::where(['id'=>$id])->delete();

			if($run){
				$json['status']=1;
				Session::flash('message', '<div class="alert alert-success">Blog has been deleted successfully.</div>'); 
			}else{
				$json['status']=0;
				Session::flash('error', '<div class="alert alert-danger">Something went wrong.</div>');
			}
		
		return back()->with('message','<div class="alert alert-success">Blog has been deleted successfully</div>');
	}
}
