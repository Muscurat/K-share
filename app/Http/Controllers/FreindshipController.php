<?php

namespace App\Http\Controllers;
use App\Recommendation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\DB;
use Response;
use App\Notifications\FriendshipsNotifications;
use App\Algorithms\FcmClass;

class FreindshipController extends Controller
{

    public function getStatus($id){

      $result = Auth::user()->getFriendship(User::find($id));

      if(!empty($result)){
          if($result['status'] == 1){
              return response()->json(['status'=>'friend'], 200);
          }else if($result['sender_id'] == Auth::user()->id){
              return response()->json(['status'=>'pending', 'type'=>'sender'], 200);
          }else{
              return response()->json(['status'=>'pending', 'type'=>'receiver'], 200);
          }
      }else{
          return response()->json(['status'=>'not friend'], 200);
      }

    }

    public function searchList(){

       $firstResult = DB::table('friendships')
            ->select('sender_id as id')
            ->where('recipient_id', '=', Auth::user()->id)
            ->where('status', '=', 2);


      $union =  DB::table('friendships')
           ->select('recipient_id  as id')
           ->where('sender_id', '=', Auth::user()->id)
           ->where('status', '=', 2)
           ->union($firstResult)
           ->get();

      $unionArray = array();

      foreach ($union as $item) {
          $unionArray[] = $item->id;
      }

           $searchResult = DB::table('users')
            ->select('userName')
            ->whereNotIn('id', $unionArray)
            ->where('id','!=',Auth::user()->id)
            ->get();

         return $searchResult;

    }

    public function searchUsers($searchField){

        $firstResult = DB::table('friendships')
            ->select('sender_id as id')
            ->where('recipient_id', '=', Auth::user()->id)
            ->where('status', '=', 2) ;


        $union =  DB::table('friendships')
            ->select('recipient_id as id')
            ->where('sender_id', '=', Auth::user()->id)
            ->where('status', '=', 2)
            ->union($firstResult)
            ->get();

        $unionArray = array();

        foreach ($union as $item) {
            $unionArray[] = $item->id;
        }

        $searchResult = DB::table('users')
            ->select('id', 'email', 'userName', 'photoPath', 'type', 'firstName', 'lastName', 'birthday')
            ->whereNotIn('id', $unionArray)
            ->where('firstName', 'LIKE', '%' . $searchField . '%')
            ->orWhere('lastName', 'LIKE', '%' . $searchField . '%')
            ->orWhere('userName', 'LIKE', '%' . $searchField . '%')
            ->get();

        return $searchResult;

    }

    // send request with status [0]
    public function send(Request $request){

        $user = User::find($request->id);
        $result = Auth::user()->befriend($user);
        if($user->fcmToken != null) {
            $score = Auth::user()->userName . ' sent to you an invitation request';
            $title = Auth::user()->userName . ' sent to you an invitation request';
            $photo = Auth::user()->photoPath;
            $fcm = new FcmClass($user->fcmToken);
            $fcm->sendToFcm($title, $score, $photo);
        }
        return $result;

      /*  if(Auth::user()->isDeniedWith($user)){

            return DB::table('friendships')
                ->where([
                        ['recipient_id','=', Auth::user()->id],
                        ['sender_id','=', $request->id]])
                ->update(array('status' => 0));

        }else{*/

       // }

    }

    //accept request with status [1]
    public function accept(Request $request){

        $user = User::find($request->id);
        $result =  Auth::user()->acceptFriendRequest($user);

        if($user->fcmToken != null){

            $score = Auth::user()->userName.' accept your invitation request';
            $title =  Auth::user()->userName.' accept your invitation request';
            $photo = Auth::user()->photoPath;
            $fcm = new FcmClass($user->fcmToken);
            $fcm->sendToFcm($title, $score, $photo);

        }

        return $result;

    }

    //remove request
    public function remove(Request $request){
       return Auth::user()->unfriend(User::find($request->id));
    }

    // deny request with status [2]
    public function deny(Request $request){
      return  Auth::user()->denyFriendRequest(User::find($request->id));
    }

    //block request with status [3]
    public function block(Request $request){
        return Auth::user()->blockFriend(User::find($request->id));
    }

    public function unblock(Request $request){
        return Auth::user()->unblockFriend(User::find($request->id));
    }

    public function listOfFreinds(){

        $freindships =  (Auth::user()->getAcceptedFriendships());

        $arr = array();
        foreach ($freindships as $freinds){

           if($freinds['sender_id'] == Auth::user()->id){
               $arr[] =User::find($freinds['recipient_id']);
           }else{
               $arr[] = User::find($freinds['sender_id']);
           }
        }
        return ($arr);

    }

    public function recommendedFriends($id){

      /*  return $tournaments = Recommendation::with(['users'=>function($query){
            // $query->addSelect(array('toast_id','qr'))
        }])
        ->where('toast_id','=',request('toast_id'))
        ->whereNotIn('id', $recommended_friends_array)
        ->orderBy('created_at','desc')
        ->get();*/

        $recommended_friends = DB::table('recommendations')
            ->select('recommended_id as id')
            ->where([['recommender_id', '=', Auth::user()->id],['toast_id', '=', $id]])
            ->get();

         $recommended_friends_array = array();

        foreach ($recommended_friends as $item) {
            $recommended_friends_array[] = $item->id;
        }

        //return $recommended_friends_array;

        $searchResult = DB::table('friendships')
            ->select('sender_id','recipient_id')
            ->where('status','=',1)
            ->whereNotIn('recipient_id', $recommended_friends_array)
            ->whereNotIn('sender_id', $recommended_friends_array)
            ->get();

        foreach ($searchResult as $item) {

            if($item->sender_id != Auth::user()->id){
                $users_list[] = $item->sender_id;
            }else{
                $users_list[] = $item->recipient_id;
            }

        }

        $searchResult = DB::table('users')
            ->select('id','userName','photoPath')
            ->whereIn('id', $users_list)
            ->get();

        return $searchResult;

    }

    public function listOfRequests(){
        return Auth::user()->getFriendRequests();
    }

    public function blockedList(){
        return (Auth::user()->getBlockedFriendships());
    }

    public function getRelation($id){

        //return Auth::user()->getFriendship(User::find($request->id));
        return Auth::user()->getRelation($id);

    }

    public function downloadImage($id){

     //$id = (int) $id;
     $filepath = public_path('/Photos/ProfilePictures/'.$id.'.png');
     return Response::download($filepath);

    }

}
