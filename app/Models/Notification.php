<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;


    function send_and_insert_notification($data)
    {
    	$not = new Notification;
    	$not->behalf_of = $data['behalf_of'];
    	$not->user_id = $data['user_id'];
    	$not->message = $data['message'];
    	$not->is_read = 0;
    	$not->other = serialize($data['other']);
    	$not->save();
    }
}

