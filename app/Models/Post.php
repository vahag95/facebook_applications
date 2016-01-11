<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	protected $fillable = array('title','user_id','description','image');
    

	public function categories()
    {
        return $this->belongsToMany('App\Models\Category','post_category');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
