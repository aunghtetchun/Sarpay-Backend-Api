<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table='categories';
    protected $fillable = [
        'user_id','book_id','name','author','main_title','chapter','title','price','ads','type','cover'
    ];
    public function getChapter()
    {
        return $this->hasMany('App\Chapter',"category_id");
    }
    public function getBuy()
    {
        return $this->hasMany('App\Buy',"category_id");
    }
}
