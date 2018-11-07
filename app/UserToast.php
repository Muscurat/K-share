<?php

namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class UserToast extends Eloquent
{

    protected $fillable = array('toast_id' ,'user_id','type', 'rate' , 'comment' , 'qr');


    protected $table = 'users_toasts';

    public function devices() {
        return $this->hasOne('App\Device');
    }

    public function stations() {
        return $this->hasOne('App\Station');
    }

    public function toasts() {
        return $this->belongsTo('App\Toast');
    }

    public function users() {
        return $this->belongsTo('App\User');
    }

}
