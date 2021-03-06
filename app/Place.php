<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    protected $fillable=['latitude','longitude','address'];
    
    public function placeable()
    {
        return $this->morphTo();
    }

    // public function user()
    // {
    //     return $this->belongsTo('App\User');
    // }

    // public function course()
    // {
    //     return $this->belongsTo('App\Course');
    // }

    // public function product()
    // {
    //     return $this->belongsTo('App\Product');
    // }
}
