<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\HappyHour;
use App\Models\Package;
use App\Models\User;
use Mail;
use Session;
use Hash;
use Validator;

class HappyController extends Controller
{
    public function happy_hour(Request  $request)
	{
		$happy_hour = HappyHour::orderBy('id','desc')->with('packagee')->get();
		$package = Package::orderBy('id','desc')->get();
		return view('admin.happy_hours',compact('happy_hour','package'));
	}

	public function add_happy_hour(Request $request) {
		$rules = [
			'package' => 'required',
			'percentage' => 'required',
			'date' => 'required'
		];
    
		$validator = Validator::make($request->all(),$rules);
		if($validator->fails()) {
			$output['validation'] = $validator->errors();
			$output['status'] = 0;
		} else {

			$package = $insert['package'] = $request->package;
			$percentage = $insert['percentage'] = $request->percentage;
			$insert['date'] = $request->date;

			$check =  HappyHour::where('package',$request->package)->where('date',$request->date)->first();
			if($check){
				$output['message'] = '<div class="label alert-danger">This package already add for today.</div>';
			    $output['status'] = 0;
			    echo json_encode($output);
			    exit();
			}
		
			$run = HappyHour::insert($insert);

			if($run){
				 $package = Package::where('id',$package)->take(1)->first();
				 $user  = User::orderBy('id','desc')->get();
				// dd($user);
				 	foreach ($user  as $key => $value) {

				 		if($value->gender == 'male'){
				 			//$message = 'Add happy hours successfully.';

				 			$message = "<p>Hi ".$value->first_name."</p>";
			                $message .= "<p>The happy hour offer on a premium package today is ".$percentage."% off from its current value. Don't wait any longer, grab this deal today</p>";
		                
			                $data['behalf_of'] = 0;
			                $data['user_id'] = $value->id;
			                $data['message'] = $message;
			                $data['other'] = array('screen' => 'happy_hour' ,'receiver'  );
			                $this->Notification= new \App\Models\Notification();
			                $run = $this->Notification->send_and_insert_notification($data);
			                //$this->common_model->InsertData('notification' ,$notifi); 


			                $body = "<style> p {font-size:18px;} </style><p><img src='".asset('admin/happy_hour/best-deal-gif.gif')."'></p>";
			                $body .= "<p>Hi ".$value->first_name."</p>";
			                $body .= "<p>The happy hour offer on a ".$package->title." package today is ".$percentage."% off from its current value. Don't wait any longer, grab this deal today</p>";
			                $body .= "<p><a href='".route('signin')."' style='background: #405189;padding: 10px;border-radius: 10px;text-decoration: none;color: #fff;'>Buy Now</a></p>";
			               
	               			/*Mail::send('emails.custom', ['data' => $body], function($message) use($value,$percentage,$package){
				              //$message->to('ashish.webwiders@gmail.com');
				              $message->to($value->email);
				              $message->subject($percentage.'% off on '.$package->title);
				          	});*/
				          	Mail::send('emails.happy_hour', ['data' => $body], function($message) use($value,$percentage,$package){
				              //$message->to('ashish.webwiders@gmail.com');
				              $message->to($value->email);
				              $message->subject($percentage.'% off on '.$package->title);
				          	});
				 		}else{
				 			continue;
				 		}
					}
				 

				$output['status']=1;
				Session::flash('message', '<div class="alert alert-success">Happy hours has been added successfully.</div>'); 
			}else{
				$output['status']=0;
				Session::flash('error', '<div class="alert alert-danger">Something went wrong.</div>');
			}
		}
		echo json_encode($output);
	}

	public function update_happy_hour(Request $request) {
		$rules = [
			'package' => 'required',
			'percentage' => 'required',
			'date' => 'required',
			'id' => 'required'
		];
    
		$validator = Validator::make($request->all(),$rules);
		if($validator->fails()) {
			$output['validation'] = $validator->errors();
			$output['status'] = 0;
		} else {
			$update['package'] = $request->package;
			$update['percentage'] = $request->percentage;
			$update['date'] = $request->date;
		
			$run = HappyHour::where('id',$request->id)->update($update);

			if($run){
				$output['status']=1;
				Session::flash('message', '<div class="alert alert-success">Happy hours has been updated successfully.</div>'); 
			}else{
				$output['status']=0;
				Session::flash('error', '<div class="alert alert-danger">Something went wrong.</div>');
			}
		}
		echo json_encode($output);
	}

	public function delete_happy_hour(Request $request) {
		//dd('hello');
		$rules = [
			'id' => ['required']
		];
    
			$id = $request->id;
		
			$run = HappyHour::where(['id'=>$id])->delete();

			if($run){
				$json['status']=1;
				Session::flash('message', '<div class="alert alert-success">Happy hours has been deleted successfully.</div>'); 
			}else{
				$json['status']=0;
				Session::flash('error', '<div class="alert alert-danger">Something went wrong.</div>');
			}
		
		return back()->with('message','<div class="alert alert-success">Happy hours has been deleted successfully</div>');
	}
}
