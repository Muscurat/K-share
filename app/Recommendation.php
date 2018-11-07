<?php

namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Recommendation extends Eloquent
{

    protected $fillable = array('recommender_id', 'recommended_id', 'toast_id', 'comment');

    protected $table = 'recommendations';

    public function toasts() {
        return $this->belongsTo('App\Toast', 'toast_id' , 'id');
    }

    public function users() {
        return $this->belongsTo('App\User', 'recommender_id' , 'id');
    }

}
