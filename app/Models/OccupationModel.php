<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OccupationModel extends Model
{
    use HasFactory;
    protected $table = 'occupation';
    protected $guarded =[];

     protected $fillable = [
		'id','title','created_at','updated_at'
	];
}
