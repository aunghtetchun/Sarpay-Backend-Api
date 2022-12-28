<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ads extends Model
{
    protected $table='ads';

    protected $fillable = [
        'code','video_one', 'video_two', 'banner_one','banner_two'
    ];
}
