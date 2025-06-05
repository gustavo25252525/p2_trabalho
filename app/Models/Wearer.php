<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wearer extends Model
{
        protected $table= 'wearers';
    
    protected $fillable= ['name', 'password', ' email'];

     public function reviews(){
          return $this->hasMany(Review::class, 'review_id', 'id');
     }
}

