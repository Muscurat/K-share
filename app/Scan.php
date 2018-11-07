<?php

namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Scan extends Eloquent
{

    protected $fillable = array('user_toast_id' ,'date');

    protected $table = 'scans';

    public function userToast() {
        return $this->belongsTo('App\UserToast');
    }

}
