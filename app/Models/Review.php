<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class review extends Model
{
        protected $table= 'reviews';
    
     protected $fillable= ['rating ', 'text','wearer_id', 'book_id'];

     public function weares(){
          return $this->belongsTo(Wearer::class, 'wearer_id', 'id');
     }
     public function books(){
          return $this->belongsTo(Book::class, 'book_id', 'id');
        }
}
