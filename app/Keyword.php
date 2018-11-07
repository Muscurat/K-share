<?php

namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Keyword extends Eloquent
{

    protected $fillable = array('toast_id' ,'keyword');


    protected $table = 'keywords';


    public function toast() {
        return $this->belongsTo('App\Toast');
    }


}
