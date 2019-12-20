<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'identifier', 'post_id',
    ];

    public function post()
    {
        return $this->belongsTo('App\Post');
    }
}
