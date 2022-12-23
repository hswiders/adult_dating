<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
class User extends  Authenticatable
{
    use HasFactory;
    protected $table = 'users';
    protected $guarded =[];

    protected $fillable = [
		'id','first_name','last_name','email','pasword','email_verified_at','status','created_at','updated_at'
	];

	protected $hidden = [
        'password',
        'remember_token',
    ];
 }
