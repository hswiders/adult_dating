<?php

use Carbon\Carbon;

use App\Models\NotificationModel;

use App\Mail;

use App\Mail\CustomMail;

use App\Models\User;
use App\Models\OccupationModel;
use App\Models\PinUsers;
use App\Models\WinkUsers;
use App\Models\nationalityModel;
use App\Models\LanguageModel;
use App\Models\EducationModel;
use App\Models\UserPhotos;
use App\Models\BlockedUsers;
use App\Models\Notification;
use App\Models\Chat;
/**

 * Write code on Method

 *

 * @return response()

 */

if (! function_exists('convertYmdToMdy')) {

    function convertYmdToMdy($date)

    {

        return Carbon::createFromFormat('Y-m-d', $date)->format('m-d-Y');

    }

}

  function getOccupation($id , $col)

    {

        $data =  OccupationModel::find($id);
        if($data)
        {
        	return $data->{$col};
        }
        else
        {
        	return '';
        }

    }

    function checkIfPin($to , $by)
    {

        $pin = PinUsers::where('pin_by' , $by)->where('pin_to' , $to)->first();
        if($pin)
        {
        	return 'fas fa-solid fa-thumbtack';
        }
        else
        {
        	return 'far fa-regular fa-thumbtack';
        }

    } 
    function checkIfWink($to , $by)
    {

        $wink = WinkUsers::where('wink_by' , $by)->where('wink_to' , $to)->first();
        if($wink)
        {
        	return 'fas fa-kiss-wink-heart text-danger ';
        }
        else
        {
        	return 'fas fa-kiss-wink-heart';
        }

    } 
    function checkIfBlocked($to , $by)
    {

        $block = BlockedUsers::where('blocked_by' , $by)->where('blocked_to' , $to)->first();
        return $block;

    }
    function totalUnreadMsg($user_id)
    {

        $where = "(sender= $user_id or receiver=$user_id) and FIND_IN_SET($user_id,read_by)=0";
        //$new_user['where'] = $where;
        $unread = Chat::whereRaw($where)->get();
        $unread = ($unread) ? count($unread) : 0;
        return $unread;

    } 
    function getUserPhotos($id , $type)

    {

        $data =  UserPhotos::where('user_id' , $id)->where('image_category' , $type)->get();
        if($data)
        {
        	return $data;
        }
        else
        {
        	return false;
        }

    } 
    function getNationality($id , $col)

    {

        $data =  nationalityModel::find($id);
        if($data)
        {
        	return $data->{$col};
        }
        else
        {
        	return '';
        }

    } 
    function getEducation($id , $col){
		$data =  EducationModel::find($id);
        if($data){
        	return $data->{$col};
        }else{
        	return '';
        }
	} 
	function getCitiesbycountry($country_id){
		$data =  DB::table('cities')->where('country_id' , $country_id)->get();
        if($data){
        	return $data;
        }else{
        	return [];
        }
	} 

	function getCountry($id , $col){
		$data =  DB::table('countries')->where('id' , $id)->first();
        if($data){
        	return $data->{$col};
        }else{
        	return [];
        }
	} 
	function getCity($id , $col){
		$data =  DB::table('cities')->where('id' , $id)->first();
        if($data){
        	return $data->{$col};
        }else{
        	return [];
        }
	} 
function getLanguages($ids)
    {
    		$ids = explode(',', $ids);
    		if(!$ids)
    		{
    			return '';
    		}
        $data =  LanguageModel::whereIn('id' , $ids)->get();
        $lang = [];
        if($data)
        {
        	foreach ($data as $key => $value) {
        		$lang[$key] = $value->title;
        	}
        	return implode(',', $lang);
        }
        else
        {
        	return '';
        }

    } 

/**

 * Write code on Method

 *

 * @return response()

 */

if (! function_exists('convertMdyToYmd')) {

    function convertMdyToYmd($date)

    {

        return Carbon::createFromFormat('m-d-Y', $date)->format('Y-m-d');

    }

}


if (! function_exists('getNotifications')) {

    function getNotifications($user_id)

    {

       $data = Notification::where('user_id' , $user_id)->get();
       return $data;

    }

}
if (! function_exists('getUnreadNotifications')) {

    function getUnreadNotifications($user_id)

    {

       $data = Notification::where(['user_id' => $user_id , 'is_read' => 0])->count();
       return $data;

    }

}



if (! function_exists('SendNotification')) {

	function SendNotification($data)

	{

		$insert2 = new NotificationModel;

		

		$data['other_data']['type'] = $data['type'];

		$other_data = $data['other_data'];

		

		

			

		$insert2->user_id = $data['user_id'];

		$insert2->behalf_of = $data['behalf_of'];

		$insert2->message = $data['message'];

		$insert2->type = $data['type'];

		$insert2->other_data = serialize($other_data);

		$insert2->save();

		

		$user = User::where('id',$data['user_id'])->first(['first_name','email','mute_notification','sms_notification','push_notification','device_id']);

		

		if($user){

			if($user->mute_notification==0){

				if($user->email_notification==1){

					$subject = 'Notification';

						

					$EmailData['email'] = $user->email;

					$EmailData['subject'] = $subject;

					$EmailData['data'] = '<p>Hello '.$user->first_name.', </p><p>'.$data['message'].'</p>';

				

					try{

						//Mail::to($EmailData['email'])->send(new CustomMail($EmailData));

					} catch(\Exception $e){

						// Get error here

					}

				}

				if($user->sms_notification==1 && $user->phone_with_code){

					

					$message = $data['message'];

					$phone = $user->phone_with_code;

					

					/*$ch = curl_init();



					curl_setopt($ch, CURLOPT_URL, 'https://rest.nexmo.com/sms/json');

					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

					curl_setopt($ch, CURLOPT_POST, 1);

					curl_setopt($ch, CURLOPT_POSTFIELDS, "from=Vonage APIs&text=A text message sent using the Vonage SMS API&to=919109916688&api_key=3a259e96&api_secret=LYI1DjRoLJJAf0pZ");



					$headers = array();

					$headers[] = 'Content-Type: application/x-www-form-urlencoded';

					curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);



					$result = curl_exec($ch);

					if (curl_errno($ch)) {

							//echo 'Error:' . curl_error($ch);

					}

					curl_close($ch);*/

					

				}

				//echo auth()->user()->id;

				//echo auth()->user()->device_id;

				if($user->push_notification==1 && $user->device_id){

					$arr = [];

					

					$arr['title'] = $data['message'];

					$arr['deviceToken'] = $user->device_id;

					$arr['other'] = $other_data;

					

					$return = SendPushNot($arr);

					/*$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");

					$txt = json_encode($return);

					fwrite($myfile, $txt);

					fclose($myfile);*/

				}

			}

		}

		return true;

	}

} 



if (!function_exists('SendPushNot')) {

	function SendPushNot($data){  

		if(!empty($data)){

    

      $content = array(

        "en" => $data['title']

      );

     

      $keyvalue = "5c1adaca-ecb1-4d97-a054-b38c8984f358";

      $hashes_array = array();

			

			$pushdata = $data['other'];

      

      $fields = array(

        'app_id' => $keyvalue,

        'include_player_ids' => [$data['deviceToken']],

        'data' => $pushdata,

        'contents' => $content,

        'web_buttons' => $hashes_array,

        //'android_channel_id' => '64afdb66-02c1-409c-8411-858b12965761',

        //'android_sound' => 'onesignal_default_sound'

      );

      

      $fields = json_encode($fields);

      //print("\nJSON sent:\n");

      //print($fields);

      

      $ch = curl_init();

      curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");

      curl_setopt($ch, CURLOPT_HTTPHEADER, array(

        'Content-Type: application/json; charset=utf-8',

        'Authorization: Basic MzMwNTdiNDEtNTFmMy00ZmFmLThlMDItYzMxNTZhMGNlOTQy'

      ));

      curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

      curl_setopt($ch, CURLOPT_HEADER, FALSE);

      curl_setopt($ch, CURLOPT_POST, TRUE);

      curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        

      $response = curl_exec($ch);

      curl_close($ch);

			

      return json_decode($response);

    } else {

      return false;

    }

	}

}



if (!function_exists('time_ago')) {

	function time_ago($timestamp){  

		$time_ago = strtotime($timestamp);  

		$current_time = time();  

		$time_difference = $current_time - $time_ago;  

		$seconds = $time_difference;  

		$minutes = round($seconds / 60) ;// value 60 is seconds

		$hours   = round($seconds / 3600); //value 3600 is 60 minutes * 60 sec

		$days    = round($seconds / 86400); //86400 = 24 * 60 * 60;

		$weeks   = round($seconds / 604800);// 7*24*60*60;

		$months  = round($seconds / 2629440);     //((365+365+365+365+366)/5/12)*24*60*60

		$years   = round($seconds / 31553280);//(365+365+365+365+366)/5 * 24 * 60 * 60  

		if($seconds <= 60) { 

		

			return "Just Now";

			

		} else if($minutes <=60) { 

		

			if($minutes==1) {  

				return "one minute ago";  

			} else {  

				return "$minutes minutes ago";  

			}  

			

		} else if($hours <=24) {  

			

			if($hours==1) {  

				return "an hour ago";  

			} else  {  

				return "$hours hrs ago";  

			}  

			

		} else if($days <= 7) {  

			if($days==1) {  

				return "yesterday";  

			} else  {  

				return "$days days ago";  

			}  

		} else if($weeks <= 4.3) {  

			

			if($weeks==1) {  

				return "a week ago";  

			}  else  {  

				return "$weeks weeks ago";  

			}  

		}  else if($months <=12) { 

		

			if($months==1) {  

				return "a month ago";  

			} else {  

				return "$months months ago";  

			}  

		}  else {  

			if($years==1) {  

				return "one year ago";  

			} else  {  

				return "$years years ago";  

			}  

		}  

	}

}

