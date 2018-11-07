<?php

namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Share extends Eloquent
{

    protected $fillable = array('toast_id' ,'link');

    protected $table = 'shares';

    public function toast() {
        return $this->belongsTo('App\Toast');
    }

}
