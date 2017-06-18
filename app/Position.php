<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    public $timestamps = false;

    protected $fillable=[
        'title',
        'departure_id'
    ];

   public function departure()
    {
        return $this->belongsTo('App\Departure');
    }
    public function employees()
    {
        return $this->hasMany('App\Employee');
    }
}
