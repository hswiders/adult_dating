<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlockedUsers;
use App\Models\Notification;
use DB;
class BlockController extends Controller
{
    public function blockUser(Request $request){

        $blocked_by = auth()->user()->id;
        $blocked_to = $request->user_id;
        $block = BlockedUsers::where('blocked_by' , $blocked_by)->where('blocked_to' , $blocked_by)->first();
        if (!$block ) 
        {
            $block = new BlockedUsers;
            $block->blocked_to = $blocked_to;
            $block->blocked_by = $blocked_by;
            $block->save();

            $data['behalf_of'] = $blocked_by;
            $data['user_id'] = $blocked_to;
            $data['message'] = 'You have been blocked by  '.auth()->user()->first_name;
            $data['other'] = array('screen' => 'blocked' ,'redirect_to' => '#' );
            $this->Notification= new \App\Models\Notification();
            $run = $this->Notification->send_and_insert_notification($data);
            
        }
        $output['status'] = 1;
        $request->session()->flash('success', 'Blocked Successfully!');
        return json_encode($output);
    }
    public function blockedUserList(){
        $user = auth()->user();
        $data['title'] = 'You blocked Them';
        $data['subtitle'] = 'Girls whom you blocked';
        $data['type'] = 'blocked';
        $data['members'] = DB::select(DB::raw('select * from users where id IN( select blocked_to from blocked_users where blocked_by = '.$user->id.' )'));
        return view('front.users.user-list-layout-2', $data);
        //return view('front.users.user-list-layout-2', $data);
    }
    public function unblockUser(Request $request){

        $blocked_by = auth()->user()->id;
        $blocked_to = $request->user_id;
        $block = BlockedUsers::where('blocked_by' , $blocked_by)->where('blocked_to' , $blocked_to)->Delete();
        if ($block ) 
        {
            $output['status'] = 1;  
            $request->session()->flash('success', 'Unblocked Successfully!');          
        } else {
            $output['status'] = 0;
            $request->session()->flash('error', 'Something went wrong!');
        }
        
        return json_encode($output);
    }
}
