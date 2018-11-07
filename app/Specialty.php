<?php

namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Specialty extends Eloquent
{

    protected $fillable = array('domain_id' ,'specialty');

    protected $table = 'specialties';


    public function users() {

        return $this->belongsToMany('App\User', 'users_specialties','specialty_id' , 'user_id')
            ->withPivot('level');
    }

    public function domains() {
        return $this->belongsTo('App\Domain' , 'domain_id' ,'id');
    }

    public function toasts() {
        return $this->hasMany('App\Toast','specialty_id','id');
    }

}
