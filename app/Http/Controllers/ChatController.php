<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Chat;
use URL;
use Validator;
use Session;
use Auth;
use Illuminate\Support\Facades\Hash;
use DB;

class ChatController extends Controller
{
    public function index()
    {
        $client_id = @$_GET['client_id'];
        $data['client_id'] = '';
        if ($client_id) {
           $client = User::find($client_id);
           if ($client) {
               $data['client_id'] = $client->id;
           }
        }
        return view('front.users.chat-page' , $data);
    }
    public function ajax_chat_between_users(Request $request)
    {
        $user = auth()->user();
        $client_user = $request->client_id;
        $my_id = $user->id;
        
        $thread_id = $this->getThreadID($client_user , $my_id);
        $chat['client_user'] = User::find($client_user);
       
        $data = ['user_id' => $my_id , 'thread_id' => $thread_id];
        $chat['my_user'] = $user;
        $chat['chats'] = $this->chat_between_users($data);
        $output['html'] = (string)view('front.users.ajax_data.chat_tab' , $chat);
        //print_r($chat); die;
        $output['client_data'] = '<li class="hidden-sm hidden-md hidden-lg">
                                                <a href="javascript:void(0)" role="button" class="pull-left m-r-40 show-contacts" data-contacts="show">
                                                    <i class="zmdi zmdi-arrow-left"></i>
                                                </a>
                                            </li>
                                            <li><a href="javascript:;" onclick="show_user_detail('.$chat['client_user']->id .')"><span class="avatar"><img id="client_img" src="'.asset($chat['client_user']->profileimage).'" alt="" class="img-circle img-sm pull-left m-r-10"></span></a></li>
                                            <li><span class="name" id="client_name">'.$chat['client_user']->full_name.'</span></li>';
       

        return json_encode($output);
        
    }
    public function ajax_chat_users(Request $request)
    {
        $user = auth()->user();
        $my_id = $user->id;
        $chat['user_id'] = $my_id;
        $chat['user_list'] = $this->chat_users($my_id);

        echo view('front.users.ajax_data.chat_users' , $chat);
    }
    public function chat_users($user_id , $type=0) {
        
    if (!$user_id) {
        return false;
    } else {
        
        $i = 0;
        
        $new_user = array();
        
        
        // $sql = "SELECT *, MAX(id) FROM `chat` WHERE  sender = '".$user_id."' or receiver = '".$user_id."' or (is_group = 1 and (select count(id) from groups where groups.id = chat.thread_id and FIND_IN_SET($user_id,groups.members) != 0) > 0) group by thread_id order by MAX(id) desc";

        $sql = "SELECT *, MAX(id) FROM `chat` WHERE (sender = '".$user_id."' or receiver = '".$user_id."' ) and (is_admin = 0 || (is_admin = 1 && sender != $user_id)) group by thread_id order by MAX(id) desc";
        
        $total_records = 0;
        $run1 = DB::select(DB::raw($sql));
        // dd($run1);
        $total_records = count($run1);
        
        $results_per_page = 10;
        $number_of_page = ceil($total_records/$results_per_page);
            
        $page_number = 1;

        $page_first_result = ($page_number - 1) * $results_per_page;
        
        //$sql .= " LIMIT $page_first_result, $results_per_page";
        
        $chats = $run1;
        
        $result = [];
        
        if($chats){
            
            foreach($chats as $row){
                
                $true = true;
               
                $other = ($row->sender==$user_id) ? $row->receiver : $row->sender;
                $data11 = User::find($other);
                
                if(!$data11){
                    $true = false;
                }
                
                if($true){
                    
                    $new_user = $row;
                    $new_user->data = $data11;
                    
                    $where = "thread_id = '".$row->thread_id."' and FIND_IN_SET($user_id,read_by)=0";
                    //$new_user['where'] = $where;
                    $unread = Chat::whereRaw($where)->get();
                    $unread = ($unread) ? count($unread) : 0;

                    
                    $new_user->unread = $unread ;
                    
                    
                    $sql1 = "SELECT message, create_date ,msg_type FROM `chat` WHERE thread_id = '".$row->thread_id."' order by id desc limit 1";
            
                    $run1 = DB::select(DB::raw($sql1));;
                    $row1 = $run1[0];
                    
                    $row1->create_date = $row1->create_date;
                    
                    $new_user->last_message = $row1;
                    
                    array_push($result,$new_user);
                } else {
                    Chat::where('thread_id' , $row->thread_id)->delete();
                    
                }
            }
            
            
            return $result;
            
        
            
        } else {
            return [];
        }
    }
    return [];
}
    public function chat_between_users($data) { 
    
    if ($data['user_id']==NULL or $data['thread_id']==NULL) {
        $output['status']=0;
        $output['msg']='Check User Param.';
    } else {
        
        $i = 0;
        
        $user_id = $data['user_id'];
        $thread_id = $data['thread_id'];
        
        $new_user = array();
        
        // $sql = "SELECT * FROM `chat` WHERE thread_id = '".$thread_id."' order by id desc limit 200";
        $sql = "SELECT * FROM `chat` WHERE thread_id = '".$thread_id."' and (is_admin = 0 || (is_admin = 1 && sender != $user_id)) order by id desc limit 200";
        $run = DB::select(DB::raw($sql));
        
        if($run){
            
            foreach($run as $row){
                
                $new_user[$i] = $row;
                
                
                if($row->read_by){
                    $read_by = explode(',',$row->read_by);
                    array_push($read_by,$user_id);
                    $read_by = array_unique($read_by);
                    $read_by = implode(',',$read_by);
                } else {
                    $read_by = $user_id;
                }
               
                $chat = Chat::find($row->id);
                $chat->read_by = $read_by;
                $chat->is_read = 1;
                $chat->save();
                 
                if($row->receiver){
                    $new_user[$i]->receiver = User::find($row->receiver) ;
                }
                if ($row->sender) 
                {
                   $new_user[$i]->sender = User::find($row->sender);
                }
                
                
                $new_user[$i]->create_date = $row->create_date;
                
                $i++;
            }
            
            $output['users'] = array_reverse($new_user);
            $output['status'] = 1;
            $output['msg'] = 'Success';
            
            if(isset($data['thread_id']) && !empty($data['thread_id'])){
                $receiver = $data['thread_id'];
                $uuser = User::find($user_id);
                $uuser->last_chat_with = $receiver;
                $uuser->last_chat_time = date('Y-m-d H:i:s');
                $uuser->save();
                
            }
            
        
            
        } else {
            $output['status'] = 0;
            $output['msg'] = 'no record found';
        }
    }
    return $output;
}
  public function ajax_send_message(Request $request)
    {
        header('Content-type text/html; charset=UTF-8');
        $user = auth()->user();
        $client_user = $request->client_id;
        $message = $request->message;
        
        $my_id = $user->id;
       
        $thread_id = $this->getThreadID($my_id , $client_user);
        
        
        
        $data = ['sender' => $my_id , 'receiver' => $client_user ,  'thread_id' => $thread_id , 'msg_type' => 'text' , 'message' => $message , 'file' => $_FILES];
        $chat['client_user'] = User::find($client_user);
        $chat['my_user'] = $user;
        $chat['chats'] = $this->send_message($data);
        return json_encode($chat);
        //echo view('loop/chat_tab' , $chat);

    } 

public function send_message($data) {
   
    
    if ($data['sender'] == NULL || $data['receiver'] == NULL   || $data['msg_type'] == NULL) 
    {
        $output['status']=0;
        $output['msg']='Check User Param.';
    } else {
        
        $i = 0;
        $file = $data['file'];
        $insert['thread_id'] = $data['thread_id'];
        $insert['sender'] = $data['sender'];
        $insert['receiver'] = isset($data['receiver']) ? $data['receiver'] : 0;
        $insert['message'] = isset($data['message']) ? $data['message'] : '';
        $insert['msg_type'] = $data['msg_type'];
        if(isset($file['files']['name']) && !empty($file['files']['name'])){
            $d = explode(".",$file['files']['name']);
            $exts=end($d);
            $f_name = rand().time().".".$exts;
            $newfile = public_path('uploads/'.$f_name);
            move_uploaded_file($file['files']['tmp_name'], $newfile);
            $insert['message'] = 'uploads/'.$f_name;
            $mime = $file['files']['type'];
            if(strstr($mime, "video/")){
                $filetype = "video";
            }
            else if(strstr($mime, "image/")){
                $filetype = "image";
            }
            else if(strstr($mime, "audio/")){
                $filetype = "audio";
            }
            else
            {
                $output['status'] = 0;
                $output['msg'] = 'Invalid file type';
                return $output;
            }  
            $insert['msg_type'] = $filetype;        
        }
        
        $insert['is_group'] = 0;
        $insert['is_read'] = 0;
        $insert['read_by'] = $data['sender'];
        $insert['create_date'] = date('Y-m-d H:i:s');
        
        $run = Chat::insert($insert);
        
        if($data['receiver'])
        {
        
            $user = User::find($data['sender']);
            $show_name = $user->full_name;
            $current = date('Y-m-d H:i:s');//11:50:50
            $tolerance = date('Y-m-d H:i:s',strtotime($current.' - 10 seconds'));//11:50:40
            
            $sql = "select last_chat_time from users where id = ".$data['receiver']." and last_chat_with = '".$insert['thread_id']."'";
            
            $run = DB::select(DB::raw($sql));
            
            $check_send = false;
            
            $numrow = count($run);
            
            if($numrow==0){
                $check_send = true;
            } else {
                $numrow = $run[0];
                if(strtotime($numrow->last_chat_time) <= strtotime($tolerance)){
                    $check_send = true;
                }
            }
            
            if($check_send){
                    
                $message = $show_name.' has sent you a message.';
                
                
                $data['behalf_of'] = $data['sender'];
                $data['user_id'] = $data['receiver'];
                $data['message'] = $message;
                $data['other'] = array('screen' => 'chat' ,'redirect_to' => route('view-chat').'?client_id='.$data['sender']  );
                $this->Notification= new \App\Models\Notification();
                $run = $this->Notification->send_and_insert_notification($data);
                //$this->common_model->InsertData('notification' ,$notifi);  
            
            
            }
        }
            
            $output['status'] = 1;
            $output['msg'] = 'message sent';
        
        } 
    
        return $output;
    } 
     public function getThreadID($user_id1 , $user_id2)
     {
         if ($user_id1 > $user_id2) 
         {
             
             return $user_id2.'_'.$user_id1;
         }
         else
         {
            return $user_id1.'_'.$user_id2;
         }
     }
}
