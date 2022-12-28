<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostLanguage extends Model
{
    public function getLanguage()
    {
        return $this->belongsTo('App\Language',"language_id");
    }
}
