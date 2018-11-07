<?php

namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Station extends Eloquent
{

    protected $fillable = array('user_toast_id' ,'name','laltitude' ,'longitude','description');

    protected $table = 'stations';

    public function userToast() {
        return $this->belongsTo('UserToast');
    }

}
