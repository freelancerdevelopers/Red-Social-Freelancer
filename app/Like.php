<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
     protected $table = 'Tbl_likes';
     
    // relacion muchos a 1
    public function user(){
        return $this->belongsTo('App\User','user_id');
    }
    
    // relacion muchos a 1
    public function image(){
        return $this->belongsTo('App\Image','image_id');
    }
}
