<?php

namespace App\Models;
use App\Models\PackageItem;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;
    public function package_item() 
    {          
     return $this->hasMany(PackageItem::class, 'package_id', 'id');        
    }
}
