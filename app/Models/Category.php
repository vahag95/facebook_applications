<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
     protected $fillable = array('title','user_id');
    

	public function posts()
    {
        return $this->belongsToMany('App\Models\Post','post_category');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
