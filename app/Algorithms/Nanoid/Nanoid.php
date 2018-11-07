<?php

namespace App\Algorithms\Nanoid;
use Hidehalo\Nanoid\Client as ClientGen;
use App\User;

class Nanoid {

    public function __construct()
    {

    }

//******************************************************************************************************************************
// method for generate an id for user registration  //
    public function generateId(){

        global $verificationId,$id;
        $verificationId = true;
        $id = 0;
        while($verificationId == true){
            $id=$this->idgenerate();
            if(is_null(User::find($id))) {
                $verificationId = false;
            }
        }
        return $id;

    }

//*******************************************************************************************************************************
// // method for generate an id for user registration //
    public function generateBarCode(){

        global $verificationBar,$barCode;
        $verificationBar = true;
        $barCode = 0;
        while($verificationBar == true){
            $barCode=$this->barCodeGenerate();
            if(is_null(User::where('barCode',$barCode) -> first())) {
                $verificationBar = false;
            }
        }
        return $barCode;

    }

    public function idgenerate(){
        return (int) (new ClientGen())->formatedId('0123456789', 10);
    }

    public function barCodeGenerate(){
        return "Kshare".(new ClientGen())->formatedId('0123456789abcdefghijklmnopqurstvwyzx', 10);
    }

}