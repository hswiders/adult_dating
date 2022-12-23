<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ViewedUsers;
use DB;
class ViewedController extends Controller
{
    public function ViewedToUserList(){
        $user = auth()->user();
        $data['title'] = 'You viewed their profiles';
        $data['subtitle'] = 'Girls whom you viewed';
        $data['type'] = 'Viewed';
        $data['members'] = DB::select(DB::raw('select * from users where id IN( select viewed_to from viewed_users where viewed_by = '.$user->id.' )'));
        return view('front.users.user-list-layout-2', $data);
        //return view('front.users.user-list-layout-2', $data);
    }
    public function ViewedByUserList(){

        $user = auth()->user();
        $data['title'] = 'They viewed your profile';
        $data['subtitle'] = 'Girls who viewed your profile';
        $data['type'] = 'Viewed';
        $data['members'] = DB::select(DB::raw('select * from users where id IN( select viewed_by from viewed_users where viewed_to = '.$user->id.' )'));
        return view('front.users.user-list-layout-2', $data);
    }
}
