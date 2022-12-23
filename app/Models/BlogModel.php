<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogModel extends Model
{
    use HasFactory;
    protected $table = 'blog';
    protected $guarded =[];

     protected $fillable = [
		'id','title','description','created_at','updated_at'
	];
}
