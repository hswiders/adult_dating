<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Package;
use App\Models\PackageItem;
use App\Models\User;
use App\Models\Subscriptions;
use Session;
use Hash;
use Validator;

class SubscriptionController extends Controller
{

	public function subscription(Request  $request)
	{
		$subscription =  Subscriptions::orderBy('id','desc')->get();
		return view('admin.subscription-list',compact('subscription'));
		
	}

	





	
}
