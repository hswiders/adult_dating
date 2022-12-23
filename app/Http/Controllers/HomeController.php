<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserModel;
use Session;
use Hash;
use Validator;

class HomeController extends Controller
{
   public function index(){
   	 return view('front.index');
   }
	
}
