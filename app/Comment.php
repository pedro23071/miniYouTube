<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';

    //Relacion de muchos a uno 
    public function user(){
        return $this->belongsTo('App\User','user_id');
    }

    public function comment(){
        return $this->belongsTo('App\Video', 'video_id');
    }
}
