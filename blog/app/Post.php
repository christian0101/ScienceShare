<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function user() {
      return $this->hasOne('App\User');
    }

    public function comments() {
      return $this->belongsToMany('App\Comment');
    }

    public function views() {
      return $this->belongsToMany('App\View');
    }

    public function votes() {
      return $this->belongsTo('App\Vote');
    }
}
