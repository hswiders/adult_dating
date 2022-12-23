<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'admins';
    protected $guarded =[];

    protected $fillable = [
        'name', 'email', 'password','phone','created_at','updated_at'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
