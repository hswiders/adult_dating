<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PinUsers;
use DB;
use App\Models\Notification;
class PinController extends Controller
{
    public function pinUser(Request $request){

        $pin_by = auth()->user()->id;
        $pin_to = $request->user_id;
        $pin = PinUsers::where('pin_by' , $pin_by)->where('pin_to' , $pin_to)->first();
        if ($pin) 
        {
            $pin->delete();
            $output['status'] = 0;
        }
       
       else
       {
            $pin = new PinUsers;
            $pin->pin_to = $pin_to;
            $pin->pin_by = $pin_by;
            $pin->save();
            $output['status'] = 1;

            $data['behalf_of'] = $pin_by;
            $data['user_id'] = $pin_to;
            $data['message'] = 'You have been pin by  '.auth()->user()->first_name;
            $data['other'] = array('screen' => 'pin' ,'redirect_to' => route('pin-by-user')  );
            $this->Notification= new \App\Models\Notification();
            $run = $this->Notification->send_and_insert_notification($data);
       }
        
        return json_encode($output);
    }

    public function pinnedToUserList(){
        $user = auth()->user();
        $data['title'] = 'You pinned Them';
        $data['subtitle'] = 'You Pinned These girls. Ηit on them!';
        $data['type'] = 'Pinned';
        $data['members'] = DB::select(DB::raw('select * from users where id IN( select pin_to from pin_users where pin_by = '.$user->id.' )'));
        return view('front.users.user-list-layout-2', $data);
        return view('front.users.user-list-layout-2', $data);
    }
    public function pinnedByUserList(){

        $user = auth()->user();
        $data['title'] = 'They pinned you';
        $data['subtitle'] = 'These girls pinned you. Ηit on them!';
        $data['type'] = 'Pinned';
        $data['members'] = DB::select(DB::raw('select * from users where id IN( select pin_by from pin_users where pin_to = '.$user->id.' )'));
        return view('front.users.user-list-layout-2', $data);
    }
}
