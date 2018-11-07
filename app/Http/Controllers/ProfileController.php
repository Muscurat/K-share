<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Image;
use Response;
use Validator;

class ProfileController extends Controller
{

 public function downloadImage()
 {

     $filepath = public_path('/Photos/ProfilePictures/'.Auth::user()->photoPath.'.png');
     return Response::download($filepath);

 }

 public  function updateImage(Request $request){

         $hinh = $request->input('image');
         Auth::user()->photoPath = Auth::user()->id;
         Auth::user()->save();
         $path = public_path('/Photos/ProfilePictures/'.Auth::user()->photoPath.'.png');
        file_put_contents($path,base64_decode($hinh));
         echo "ok";
       
 }

 public function updateInfos(Request $request){

     $validator = Validator::make($request->all(), [
         'email' => 'unique:users,email,'.Auth::user()->id,
         'userName' => 'unique:users,userName,'.Auth::user()->id,
     ]);

     if ($validator->fails()) {

         $result = $validator->errors();

         $ar = json_decode($result);

         if(property_exists($ar, 'email') && property_exists($ar, 'userName')){

             return response()->json(['error' =>true , 'messages' => $ar->email[0].",".$ar->userName[0]], 200, [], JSON_NUMERIC_CHECK);

         }elseif(property_exists($ar ,'email')){

             return response()->json(['error' =>true , 'messages' => $ar->email[0]], 200, [], JSON_NUMERIC_CHECK);

         }else{

             return response()->json(['error' =>true , 'messages' => $ar->userName[0]], 200, [], JSON_NUMERIC_CHECK);

         }

     }else{

         $user = Auth::user();

         $user->firstName = $request->firstName;
         $user->lastName = $request->lastName;
         $user->userName = $request->userName;
        // $user->password = bcrypt($request->password);
         $user->birthday = $request->birthday;
         $user->email = $request->email;
         $user->type= $request->type;
         $user->occupation = $request->occupation;
         $user->searchField = $request->searchField;
         $user->studyLevel = $request->studyLevel;
         $user->domain = $request->domain;
         $user->specialty = $request->specialty;

        $user->save();

        return response()->json(['error' =>false], 200, [], JSON_NUMERIC_CHECK);

     }
 }
 
}
