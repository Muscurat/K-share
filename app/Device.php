<?php

namespace App;


use Illuminate\Database\Eloquent\Model as Eloquent;

class Device extends Eloquent
{


    protected $fillable = array('user_toast_id' ,'os_version','api_version' ,'device','model');


    protected $table = 'devices';


    public function userToast() {
        return $this->belongsTo('App\UserToast');
    }

}
