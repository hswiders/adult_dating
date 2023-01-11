<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Package;

class HappyHour extends Model
{
   use HasFactory;
    protected $table = 'happy_hours';
    protected $guarded =[];

     protected $fillable = [
		'id','package','percentage','date','created_at','updated_at'
	];

	public function packagee() 
    {          
     return $this->hasOne(Package::class, 'id', 'package');        
    }
}
