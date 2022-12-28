<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public function getBook()
    {
        return $this->hasMany('App\Book',"group_id");
    }
}
