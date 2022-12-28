<?php

namespace App;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Reader extends Authenticatable
{
    use HasApiTokens,Notifiable;

    protected $guard = 'reader';

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
    public function getBuy()
    {
        return $this->hasMany('App\Buy',"reader_id");
    }


}
