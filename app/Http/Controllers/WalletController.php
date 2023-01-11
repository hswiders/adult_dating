<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use URL;
use Validator;
use Session;
use Auth;
use App\Models\Package;
use App\Models\Subscriptions;
use App\Models\Transactions;
use App\Models\User;
use App\Models\PaymentSetting;
use Illuminate\Support\Facades\Hash;
use DB;

class WalletController extends Controller
{
    public function index() {
        $user = auth()->user();
        $data['incoming'] = Transactions::where('user_id',$user->id)->where('type',1)->sum('coins');
        $data['outgoing'] = Transactions::where('user_id',$user->id)->where('type',2)->sum('coins');
    
        $data['wallet_sidebar'] = true;
    	return view('front.users.wallet_dashboard' , $data);
    }
    public function selectPackage() {
        $user = auth()->user();
        $data['wallet_sidebar'] = true;
    	return view('front.users.select-package' , $data);
    }
    public function getPackages(Request $request) {
        $user = auth()->user();
        $data['packages'] = Package::with('package_item')->get();
       
    	$output['html'] =  (string)view('front.users.ajax_data.package-data' , $data);
    	$output['status'] =  1;
        return json_encode($output);

    }
    public function getPaymentMethod(Request $request) {
        $user = auth()->user();
        
        $data['package'] = Package::find($request->package_id);
       
    	$output['html'] =  (string)view('front.users.ajax_data.payment-data' , $data);
    	$output['status'] =  1;
        return json_encode($output);

    }
    public function confirmPayment(Request $request) {
        $user = auth()->user();
        $coins = $user->wallet_coins;
        
        $package = Package::find($request->package_id);
        $subscription = new Subscriptions();
        $subscription->user_id = $user->id;
        $subscription->package_id = $package->id;
        $subscription->price = $package->price;
        $subscription->coins = $package->coins;
        $subscription->payment_method = 'mypos';
        $subscription->order_data = $request->order_data;
        $subscription->save();

        $transaction = new Transactions();
        $transaction->user_id = $user->id;
        $transaction->coins = $package->coins;
        $transaction->type = 1;
        $transaction->purpose = 'Wallet Loaded';
        $transaction->save();

        $user->wallet_coins = $coins + $package->coins;
        $user->save();
    	$output['status'] =  1;
    	$output['message'] =  'Coins Loaded Successfully';
    	$output['redirect'] = route('wallet-dashboard');

        return json_encode($output);

    }
    public function price_list() {
        $user = auth()->user();
        $data['wallet_sidebar'] = true;
        $data['payment_setting'] = PaymentSetting::where('id',1)->take(1)->first();
        return view('front.users.price_list' , $data);
    }
}
