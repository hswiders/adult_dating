<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use URL;
use Validator;
use Session;
use Auth;
use App\Models\OccupationModel;
use App\Models\User;
use App\Models\LanguageModel;
use App\Models\nationalityModel;
use App\Models\EducationModel;
use App\Models\UserPhotos;
use App\Models\ViewedUsers;
use Illuminate\Support\Facades\Hash;
class SearchMembers extends Controller
{
    public function index(Request $request)
    {
       $user = User::where('id','!=' , auth()->user()->id);

       if ($request->page_type == 'is_online') {
           $user->where('online_status', '=', 1)->where(function ($query) 
            {
                $loggedUser = auth()->user();
                $query->where('city' , $loggedUser->city)->orWhere('country' , $loggedUser->country);
            });
       }
       if ($request->page_type == 'city') {
           
            $loggedUser = auth()->user();
            $user->where('city' , $loggedUser->city);
          
       }
       if ($request->page_type == 'country') {
           
            $loggedUser = auth()->user();
            $user->where('country' , $loggedUser->country);
          
       }

       if ($request->page_type == 'pin_by') {
           
            $loggedUser = auth()->user();
            $user->whereRaw('id IN( select pin_by from pin_users where pin_to = '.$user->id.' )');
          
       }

       if (isset($request->search_key)) {
           $keyword = $request->search_key;
           $user->where(function($query) use ($keyword){
           $query->where('first_name', 'like', '%' . $keyword . '%')
                ->orWhere('last_name', 'like', '%' . $keyword . '%');
                
        });
       }
       if (isset($request->city)) {
           $keyword = $request->city;
           $user->where('city', $keyword );
       }

       if (isset($request->country)) {
           $keyword = $request->country;
           $user->where('country',  $keyword );
       }
       if (isset($request->age_to) && isset($request->age_from)) {
           $user->whereBetween('age', [$request->age_from, $request->age_to]);
       }
       $loggedUser = auth()->user();
       $user->whereRaw('id NOT IN( select blocked_to from blocked_users where blocked_by = '.$loggedUser->id.' )');
       // $sql = $user->toSql();
       //  $bindings = $user->getBindings();

       //  $sql_with_bindings = preg_replace_callback('/\?/', function ($match) use ($sql, &$bindings) {
       //      return json_encode(array_shift($bindings));
       //  }, $sql);
       //  dd($sql_with_bindings);
       $members = $user->paginate(15);
       //dd($members->items());
       $output['members_list'] = (string)view('front.users.ajax_data.user_listing' , ['members' => $members->items()]);
       $output['pagination_link'] = (string) $members->withQueryString()->links('pagination::bootstrap-5');
       if (isset($request->layout) && isset($request->layout)) {
           $output['members_list'] = (string)view('front.users.ajax_data.user_listing-layout2' , ['members' => $members->items()]);
           
       }
       return json_encode($output);
   }

   public function memberDetails(Request $request)
    {
       $member = User::find($request->id);
       $loggedUser = auth()->user();
       $viewed = ViewedUsers::where('viewed_by',$loggedUser->id)->where('viewed_to',$request->id)->first();
       if(empty($viewed))
       {
         $view = new ViewedUsers;
         $view->viewed_by = $loggedUser->id;
         $view->viewed_to = $request->id;
         $view->save();
       }
       $output['html'] = (string)view('front.users.ajax_data.user_detail' , ['member' => $member]);
       return json_encode($output);
   }
}
