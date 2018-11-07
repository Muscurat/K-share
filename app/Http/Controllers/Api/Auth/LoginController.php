<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Laravel\Passport\Client;
use Validator;
use \phputil\JSON;
use App\User;
use Illuminate\Support\Facades\Input;

class LoginController extends Controller
{

    use IssueTokenTrait;

	private $client;
    public $successStatus = 200;

	public function __construct(){
		$this->client = Client::find(2);
    
	}

    // login method

    public function login(Request $request){
 

        if(Auth::attempt([filter_var(request('userName'), FILTER_VALIDATE_EMAIL) ? 'email' : 'userName' =>
          request('userName'),'password' => request('password')])){

             $user = Auth::user();
             $token =  $user->createToken('MyApp')->accessToken;

                $user->fcmToken = request('fcmToken');
                $user->save();

                $member = DB::table('users_specialties')
                ->where('user_id','=', Auth::user()->id)->first();

                if($member != null){
                      $member = 1;

                }else{
                      $member = 0;

                }
          
            return response()->json(['user'=>['id'=>$user->id, 'barCode'=>$user->barCode , 'photoPath'=>$user->photoPath ,
                     'firstName'=>$user->firstName ,'lastName'=>$user->lastName, 'userName'=>$user->userName,
                     'password'=>$user->password, 'birthday'=>$user->birthday, 'email'=>$user->email, 
                     'type'=>$user->type, 'occupation'=>$user->occupation, 'searchField'=>$user->searchField,
                     'studyLevel'=>$user->studyLevel,'domain'=>$user->domain, 'specialty'=>$user->specialty,
                     'token'=>$token], 'member' => $member],200, [], JSON_NUMERIC_CHECK);
  

          }else{ 
            return response()->json(['error'=>'invalid_credentials'], 401);
        }
    }

    public function logout(Request $request){

        $user = Auth::user();
        $user->fcmToken = null;
        $user->save();

    	$accessToken = Auth::user()->token();

    	DB::table('oauth_refresh_tokens')
    		->where('access_token_id', $accessToken->id)
    		->update(['revoked' => true]);

    	$accessToken->revoke();

    	return response()->json([], 204);

    }

    public function logoutTeacher(Request $request){

        Auth::logout();
        Session::flush();
        return view('login');

    }

    public function showLogin(Request $request){

          if(Auth::check()){
            return redirect('api/toast');
          }else{
            return view('login');
          }

    }

    public function loginTeacher(Request $request){

                $remember = (Input::has('remember')) ? true : false;

                if(Auth::attempt([filter_var(request('userName'), FILTER_VALIDATE_EMAIL) ?
                'email' : 'userName' =>
                request('userName'),'password' => request('password')], $remember)){

                         //$token = Auth::user()->createToken('MyApp')->accessToken;
                         return redirect('api/toast');

                }else{

                         return response()->json(['error'=>'invalid_credentials'], 401);
                         
                }
    }

    public function validationCard(Request $request){

       $barcode=$request->barcode;
       $user = DB::table('users')
                  ->select('id')
                  ->where('barCode', '=', $barcode)->first();

        if ($user != null) {
           
             $user = User::find($user->id);
             $token = $user->createToken('token')->accessToken;
             return json_encode(['response'=>'yes','token'=>$token]);

        }else{ 

            return json_encode(['response'=>'no']);
        
        }      
  }   

}