<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Response;
use Redirect;
use App\Models\Notification;
class DropdownController extends Controller
{
    
    public function fetchCity(Request $request)
    {
        $data['cities'] = DB::table('cities')->where("country_id",$request->country_id)->orderBy('name' ,'asc')->get(["name", "id"]);
        return response()->json($data);
    }
    public function readNoti(Request $request)
    {
        $noti = Notification::find($request->id);
        if ($request->remove != 'no') 
        {
           $noti->delete();
        }
        else
        {
            $noti->is_read = 1;
            $noti->save();
        }
        
        $data['status'] = 1;
        return response()->json($data);
    }
}
