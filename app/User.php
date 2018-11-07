<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Hootlex\Friendships\Traits\Friendable;

class User extends Eloquent implements AuthenticatableContract, CanResetPasswordContract
{
    use Notifiable, HasApiTokens,Friendable;
    use  Authenticatable, CanResetPassword;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','firstName','lastName','birthday','email','password','type','occupation','studyLevel','searchField',
        'specialty','domain','userName','barCode','photoPath'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function specialties() {
        return $this->belongsToMany(Specialty::class, 'users_specialties', 'user_id' , 'specialty_id' )
            ->withPivot('level')->withTimestamps();
    }

    public function userToasts() {
        return $this->hasMany('App\UserToast');
    }

    public function toasts(){
       // return $this->hasMany('Toast');
            return $this->hasMany('App\Toast');
    }

    public function recommendations() {
        return $this->hasMany('App\Recommendation');
    }

    public function freindships() {
        return $this->hasMany('App\Friendship', 'freindship','id_requester' , 'id_requested');
    }

    public function findForPassport($identifier) {
        return $this->orWhere('email', $identifier)->orWhere('userName', $identifier)->first();
    }


    public function getRememberToken()
     {
            return $this->remember_token;
     }


     public function setRememberToken($value)
    {
            $this->remember_token = $value;
    }   

    public function getRememberTokenName()
    {
           return 'remember_token';
    }
}
