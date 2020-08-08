<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    //
    protected $fillable = ['post_id','user_id'];

    public function like(){
        return $this->belongsTo('App\User');
    }
}
