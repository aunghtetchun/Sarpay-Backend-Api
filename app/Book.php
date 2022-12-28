<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table='books';

    protected $fillable = [
        'user_id','name', 'author', 'title','group_id', 'chapter', 'price', 'type', 'cover','popular','status'
    ];
    public function getCategory()
    {
        return $this->hasMany('App\Category',"book_id");
    }
    public function getGroup()
    {
        return $this->belongsTo('App\Group',"group_id");
    }
    public function getRCategory()
    {
        return $this->hasMany('App\Category',"book_id")->where('type','release');
    }

}
