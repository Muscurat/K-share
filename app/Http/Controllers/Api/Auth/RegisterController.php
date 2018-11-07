<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Algorithms\Nanoid\Nanoid;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\Client;
use Validator;


class RegisterController extends Controller
{
    use IssueTokenTrait;

	private $client;

	public function __construct(){
		$this->client = Client::find(2);
	}

    public function register(Request $request){

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email',
            'userName' => 'required|unique:users,userName',
          //  'password' => 'required|min:6',
           // 'password' => 'required|min:6|confirmed',
           // 'type' => 'required',

        ]);


        if ($validator->fails()) {

           //return $validator->errors();
            $result = $validator->errors();

            $ar = json_decode($result);


            if(property_exists($ar, 'email') && property_exists($ar, 'userName')){

                //return $ar->email[0];
                return response()->json(['error' =>true , 'messages' => $ar->email[0].",".$ar->userName[0]], 200, [], JSON_NUMERIC_CHECK);

               
            }elseif(property_exists($ar ,'email')){

                return response()->json(['error' =>true , 'messages' => $ar->email[0]], 200, [], JSON_NUMERIC_CHECK);

            }else{

                return response()->json(['error' =>true , 'messages' => $ar->userName[0]], 200, [], JSON_NUMERIC_CHECK);

            }

        }else{


            $nanoid = new Nanoid();
            $id = $nanoid->generateId();

            if($request->barCode == ""){
                $barCode = $nanoid->generateBarCode();
            }else{
                $barCode = $request->barCode;
            }

            $user = User::create([
                'firstName' => request('firstName'),
                'id' => $id,
                'barCode' => $barCode,
                'photoPath' => 'default',
                'lastName' => request('lastName'),
                'birthday' => request('birthday'),
                'email' => request('email'),
                'password' => bcrypt(request('password')),
                'type' => request('type'),
                'occupation' => request('occupation'),
                'searchField' => request('searchField'),
                'studyLevel' => request('studyLevel'),
                'domain' => request('domain'),
                'specialty' => request('specialty'),
                'userName' => request('userName')
            ]);

            return response()->json(['error' =>false , 'messages' => "success"], 200, [], JSON_NUMERIC_CHECK);

        }
    }
}
