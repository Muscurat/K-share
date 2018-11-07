<?php

namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Domain extends Eloquent
{

    protected $fillable = array('domain' , 'photoPath');

 
    protected $table = 'domains';


    public function specialties() {
        return $this->hasMany('App\Specialty');
    }


}
