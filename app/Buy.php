<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Buy extends Model
{

    public function getBooks()
    {
        return $this->belongsTo('App\Category','category_id');
    }
    public function getBook()
    {
        return $this->belongsTo('App\Category','category_id');
    }
}
