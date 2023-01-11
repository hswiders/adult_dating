<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentSetting extends Model
{
   use HasFactory;
    protected $table = 'payment_setting';
    protected $guarded =[];

     protected $fillable = [
		'id','men_send_msg_price','men_send_image_price','men_send_video_price','men_recieve_video_price','men_recieve_image_price','women_commission','created_at','updated_at'
	];
}
