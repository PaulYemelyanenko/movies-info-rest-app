<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = [
        'user_id', 'name', 'year', 'format', 'actor_fullname'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
