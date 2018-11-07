<?php

namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Friendship extends Eloquent
{

    protected $fillable = array('sender_id' ,'sender_type', 'recipient_id', 'recipient_type', 'status', 'blocked_user');

    protected $table = 'friendships';

    public function users() {
        return $this->belongsTo('App\User');
    }


}
