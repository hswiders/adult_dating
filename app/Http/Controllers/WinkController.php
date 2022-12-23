<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WinkUsers;
use DB;
use App\Models\Notification;
class WinkController extends Controller
{
    public function winkUser(Request $request){

        $wink_by = auth()->user()->id;
        $wink_to = $request->user_id;
        $wink = WinkUsers::where('wink_by' , $wink_by)->where('wink_to' , $wink_to)->first();
        if (!$wink ) 
        {
            $wink = new WinkUsers;
            $wink->wink_to = $wink_to;
            $wink->wink_by = $wink_by;
            $wink->save();
            
        }
        $data['behalf_of'] = $wink_by;
            $data['user_id'] = $wink_to;
            $data['message'] = 'You have been wink by  '.auth()->user()->first_name;
            $data['other'] = array('screen' => 'wink' ,'redirect_to' => route('wink-by-user')  );
            $this->Notification= new \App\Models\Notification();
            $run = $this->Notification->send_and_insert_notification($data);
        $output['status'] = 1;
        return json_encode($output);
    }
    public function WinkedToUserList(){
        $user = auth()->user();
        $data['title'] = 'You Winked Them';
        $data['subtitle'] = 'You Winked These girls. Ηit on them!';
        $data['type'] = 'Winked';
        $data['members'] = DB::select(DB::raw('select * from users where id IN( select wink_to from wink_users where wink_by = '.$user->id.' )'));
        return view('front.users.user-list-layout-2', $data);
        //return view('front.users.user-list-layout-2', $data);
    }
    public function WinkedByUserList(){

        $user = auth()->user();
        $data['title'] = 'They Winked you';
        $data['subtitle'] = 'These girls Winked you. Ηit on them!';
        $data['type'] = 'Winked';
        $data['members'] = DB::select(DB::raw('select * from users where id IN( select wink_by from wink_users where wink_to = '.$user->id.' )'));
        return view('front.users.user-list-layout-2', $data);
    }
}
