<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Auth::routes();
//**********************************************************************************************************************
Route::post('register', 'Api\Auth\RegisterController@register'); // route for register a new user

Route::post('refresh', 'Api\Auth\LoginController@refresh');

Route::post('social_auth', 'Api\Auth\SocialAuthController@socialAuth');

Route::post('resset', 'Api\Auth\ForgotPasswordController@postForgotPassword'); // route for resset email of user

Route::get('login','Api\Auth\LoginController@showLogin')->name('login');

Route::post('login', 'Api\Auth\LoginController@login'); // route for send login information

Route::post('login/teacher','Api\Auth\LoginController@loginTeacher');

Route::get('card/validation','Api\Auth\LoginController@validationCard');

//**********************************************************************************************************************

//middleware for teacher routes*****************************************************************************************
Route::group(['middleware' => 'is-teacher'], function () {

      Route::get('toast','ToastController@index');

      Route::get('toast/details','ToastController@showDetails');

      Route::get('toast/create','ToastController@getDomain');

      Route::post('toast/create','ToastController@createToast');

      Route::get('toast/update/{toastId}','ToastController@getToastInformation');

      Route::put('toast/update/{toastId}','ToastController@updateToast');

      Route::delete('toast/delete','ToastController@deleteToast');

      Route::get('toast/logout','Api\Auth\LoginController@logoutTeacher');

      Route::post('tableau','HomeController@index');

});
//**********************************************************************************************************************

Route::get('toast/test' , 'ToastController@test');

/*Route::get('toast/print',function(){

    return response()->json(['response'=>'ok'], 200);
    //return 'hhh';

});*/

//middleware for android application routes*****************************************************************************
Route::middleware('auth:api')->group(function (){

    //save a toast as viewed
    Route::put('toast/{id}','ToastController@toastViewed');

    //show toasts to users
    Route::get('toast/timeLine','ToastController@toastTimeLine');

    //print a toast
    Route::get('toast/print','ToastController@printToast');

    //Share a toast
    Route::post('toast/share','ToastController@shareToast');

    //recommand a toast to friend
    Route::post('toast/recommendation','ToastController@recommandToast');

    //get racommended toasts list
    Route::get('toast/recommendation','ToastController@recommendedToastsList');

    //show recommended toast
    Route::get('toast/recommendation/{id}','ToastController@recommendedToast');

    //get list of friends to reommend a toast to them
    Route::get('toast/friends/{id}','FreindshipController@recommendedFriends');

    //logout
    Route::get('logout', 'Api\Auth\LoginController@logout'); // logout an authenticated user

    //barcode
    Route::get('generate' ,'BarCodeGenerator@generate'); // generate a bar code for user

    //manage profile
    Route::get('profile/downImage' ,'ProfileController@downloadImage');//download profile picture of user

    Route::post('profile/upImage' ,'ProfileController@updateImage'); // update profile picture of user

    Route::post('profile/updateInfo' ,'ProfileController@updateInfos'); // update infos of user

    //manage freindship
    Route::get('friendship/search/{searchField}' , 'FreindshipController@searchUsers');

    Route::get('friendship/list' , 'FreindshipController@searchList');

    Route::get('friendship/status/{id}' , 'FreindshipController@getStatus');

    Route::post('friendship/send' , 'FreindshipController@send');

    Route::post('friendship/accept' , 'FreindshipController@accept');

    Route::delete('friendship/remove' , 'FreindshipController@remove');

    Route::post('friendship/deny' , 'FreindshipController@deny');

    Route::post('friendship/block' , 'FreindshipController@block');

    Route::delete('friendship/unblock' , 'FreindshipController@unblock');

    Route::get('friendship/friends' , 'FreindshipController@listOfFreinds');

    Route::get('friendship/requests' , 'FreindshipController@listOfRequests');

    Route::get('friendship/blockedList' , 'FreindshipController@blockedList');

    Route::get('friendship/single' , 'FreindshipController@single');

    Route::get('friendship/downImage/{id}' ,'FreindshipController@downloadImage');

    Route::get('friendship/recommended','FreindshipController@recommendedFriends');

    // manage domains and specialities
    Route::get('domain' , 'DomainController@getDomain');

    Route::post('domain/interestPoints' , 'DomainController@setInterestPoints');

    Route::get('domain/photo/{photoPath}' , 'DomainController@getPhoto');

    // Toast reaction
    Route::post('toast/reaction','ToastController@toastReaction');

});
//**********************************************************************************************************************
