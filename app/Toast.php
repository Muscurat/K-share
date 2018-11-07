<?php

namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Toast extends Eloquent
{

    protected $fillable = array('specialty_id' ,'user_id' ,'text' ,'difficulty' ,'language' ,'link','title', 'reaction');


    protected $table = 'toasts';


    public function shares() {
        return $this->hasMany('App\Share');
    }

    public function keywords() {
        return $this->hasMany('App\Keyword' , 'toast_id', 'id');
    }

    public function userToasts() {
        return $this->hasMany('App\UserToast');
    }

    public function users(){
        return $this->belongsTo('App\User' ,'user_id' , 'id');
    }

    public function recommendations() {
        return $this->hasMany('App\Recommendation');
    }

    public function specialties() {
        return $this->belongsTo('App\Specialty' , 'specialty_id' , 'id');
    }

}
