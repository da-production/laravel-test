<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    //
    use SoftDeletes;
    protected $fillable = ['user_id','title', 'content'];

    public function likes(){
        return $this->hasMany('App\Like');
    }
}
