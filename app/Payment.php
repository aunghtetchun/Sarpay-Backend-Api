<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{

    public function getReader()
    {
        return $this->belongsTo('App\Reader',"reader_id");
    }
}
