<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function getPhoto()
    {
        return $this->hasMany('App\Photo',"post_id");
    }
    public function getCategory()
    {
        return $this->belongsTo('App\Category',"category_id");
    }

    public function languages(){
        return $this->belongsToMany(Language::class, 'post_languages');
    }
}
