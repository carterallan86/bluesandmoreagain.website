<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    // Table Name
    protected $table = 'reviews';
    // Primary Key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;

     
    public function user(){
        return $this->belongsTo('App\User');
    }

    public function comments(){

        return $this->hasMany('App\Comment');
    }
    
}

