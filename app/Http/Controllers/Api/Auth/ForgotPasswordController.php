<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Reminder;


class ForgotPasswordController extends Controller
{

    public function postForgotPassword(Request $request){
        $user = User::whereEmail($request->email)->first();

        /*if(count($user)>0){

            return response()->json(['message' =>"Reset code was sent to your email"], 200, [], JSON_NUMERIC_CHECK);

        }*/

        $reminder = Reminder::exists($user) ?: Reminder::create($user);

    }
}
