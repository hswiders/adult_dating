<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PaymentSetting;
use App\Models\User;
use Mail;
use Session;
use Hash;
use Validator;

class PaymentSettingController extends Controller
{
     public function payment_setting(Request  $request)
	{
		$payment_setting = PaymentSetting::where('id',1)->take(1)->first();
		return view('admin.update_payment_setting',compact('payment_setting'));
	}

	public function update_paymentSetting(Request $request) {
		//dd('hello');
		$rules = [
			'men_send_msg_price' => 'required',
			'men_send_image_price' => 'required',
			'men_send_video_price' => 'required',
			'men_recieve_video_price' => 'required',
			'men_recieve_image_price' => 'required',
			'women_commission' => 'required',
			'id' => 'required'
		];
    
		$validator = Validator::make($request->all(),$rules);
		if($validator->fails()) {
			$output['validation'] = $validator->errors();
			$output['status'] = 0;
		} else {
			$update['men_send_msg_price'] = $request->men_send_msg_price;
			$update['men_send_image_price'] = $request->men_send_image_price;
			$update['men_send_video_price'] = $request->men_send_video_price;
			$update['men_recieve_video_price'] = $request->men_recieve_video_price;
			$update['men_recieve_image_price'] = $request->men_recieve_image_price;
			$update['women_commission'] = $request->women_commission;
		
			$run = PaymentSetting::where('id',$request->id)->update($update);

			if($run){
				$output['status']=1;
				Session::flash('message', '<div class="alert alert-success">Payment setting has been updated successfully.</div>'); 
			}else{
				$output['status']=0;
				Session::flash('error', '<div class="alert alert-danger">Something went wrong.</div>');
			}
		}
		echo json_encode($output);
	}
}
