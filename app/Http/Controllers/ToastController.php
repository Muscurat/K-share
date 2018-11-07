<?php

namespace App\Http\Controllers;

use App\Algorithms\FcmClass;
use App\Algorithms\Toast\ToastPdf;
use App\Device;
use App\Domain;
use App\Keyword;
use App\Recommendation;
use App\Share;
use App\Specialty;
use App\Station;
use App\Toast;
use App\User;
use App\UserToast;
use Defuse\Crypto\Key;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Global_;

class ToastController extends Controller
{

    // get all toasts
    public function index(){

        $toasts = DB::table('toasts')
                ->join('specialties', 'toasts.specialty_id', '=', 'specialties.id')
                ->join('users' , 'toasts.user_id','=','users.id')
                ->select('specialties.specialty','toasts.title','toasts.created_at','toasts.id')
                ->where('toasts.user_id', '=', Auth::user()->id)
                ->get();
        return response(view('toasts',[ 'toasts' => $toasts]),200);

    }

    // get domain and specialties of teacher
    public function getDomain(){

        $data = Domain::with('specialties')->where('domains.domain' ,'=', Auth::user()->searchField)->first();
        return response($data, 200);

    }

    // create a new toast
    public function createToast(){

        $toast = Toast::create([
            'specialty_id' => (int)request('specialty'),
            'user_id' => Auth::user()->id,
            'title' => request('title'),
            'text' => request('toast'),
            'difficulty ' => request('difficulty'),
            'language' => 'english',
            'link' => request('link'),
        ]);

        $keywords = request('keywords');

        if(!empty($keywords)){
            foreach($keywords as $keyword) {

                Keyword::create([
                    'toast_id' => $toast->id,
                    'keyword' => $keyword
                ]);
            }
        }

        return response()->json(['response'=>'ok'], 200);

    }

   // delete a toast
    public function deleteToast(){

        $result = DB::table('toasts')->where([['id','=',request('id')] , ['user_id','=',Auth::user()->id]])->delete();

        return response()->json(['response'=>$result], 200);

    }

   // get information of selected toast
    public function getToastInformation($toastId){

        $toastInformation =  Toast::with('specialties')
            ->with('specialties.domains')
            ->with(['keywords'=>function($query){
                $query->select('toast_id','keyword');
            }])
            ->where([
                ['id', '=' , $toastId],
                ['user_id', '=' , 721782232]])
            ->get();

        return response()->json(['toastInformation'=>$toastInformation], 200);

    }

   // Update the selected toast
    public function updateToast($toastId){

       DB::table('toasts')
            ->where([['user_id','=',Auth::user()->id],['id','=',$toastId]])
            ->update(['title' => request('title'),
                      'text' => request('toast'),
                      'difficulty' => request('difficulty'),
                      'language' => 'english',
                      'link' => request('link')
        ]);

       $keywords = request('keywords');

       Keyword::where('toast_id', '=', $toastId)->delete();

       if(!empty($keywords)){
            foreach($keywords as $keyword) {
                Keyword::create([
                    'toast_id' => $toastId,
                    'keyword' => $keyword
                ]);
            }
       }

        return response()->json(['response'=>'ok'], 200);

    }

   // Print the toast from the distributor
    public function printToast(){

        foreach (Auth::user()->specialties as $specialty)
            $specialties[] = $specialty->id;

        foreach (Auth::user()->userToasts as $userToast)
            $viewedToasts[] = $userToast->toast_id;

        $printedToast =Toast::with(['users'=>function($query){
            // $query->addSelect(array('toast_id','qr'))
        }])
            ->with(['specialties'=>function($query){
                //$query->addSelect(array('toast_id','comment'))
            }])
            ->with(['specialties.domains'=>function($query){
                //$query->addSelect(array('toast_id','comment'))
            }])

            ->whereIn('specialty_id',$specialties)
            ->whereNotIn('id',$viewedToasts)
            ->orderBy('reaction','desc')
            ->take(1)
            ->get();

        if(count($printedToast) > 0){

            $user_toast = new UserToast;
            $user_toast->user_id = Auth::user()->id;
            $user_toast->toast_id = $printedToast[0]->id;
            $user_toast->type = 'printed';
            $user_toast->save();

            $station = new Station;
            $station->user_toast_id = $user_toast->id;
            $station->name=request('name');
            $station->latitude=request('latitude');
            $station->longitude=request('longitude');
            $station->description=request('description');
            $station->save();

            return response()->json($printedToast[0],200);

            /*$user_toast = UserToast::updateOrCreate(['user_id' => Auth::user()->id, 'toast_id' => $union1->id],
                ['type' => 'printed']);*/

          /*  Station::firstOrCreate(['user_toast_id' => $user_toast->id],['name' => request('name'), 'latitude' => request('latitude'),
                'longitude' => request('longitude'), 'description' => request('description')]);*/

        }else{

            $printedToast =Toast::with(['users'=>function($query){
                // $query->addSelect(array('toast_id','qr'))
            }])
                ->with(['specialties'=>function($query){
                    //$query->addSelect(array('toast_id','comment'))
                }])
                ->with(['specialties.domains'=>function($query){
                    //$query->addSelect(array('toast_id','comment'))
                }])

                ->whereIn('specialty_id',$specialties)
                ->whereIn('id',$viewedToasts)
                ->orderBy('reaction','desc')
                ->get();

            $printedToast = $printedToast[rand(1,count($printedToast))-1];

            $typeOfPrintedToast = DB::table('users_toasts')->select('type','id')
                                     ->where([['toast_id','=',$printedToast->id],['user_id','=',Auth::user()->id]])
                                     ->first();

            if($typeOfPrintedToast->type != 'printed'){

             //   $typeOfPrintedToast->type="printed";

                DB::table('users_toasts')
                    ->where([['toast_id','=',$printedToast->id],['user_id','=',Auth::user()->id]])
                    ->update(['type' => "printed"]);

                $station = new Station;
                $station->user_toast_id = $typeOfPrintedToast->id;
                $station->name=request('name');
                $station->latitude=request('latitude');
                $station->longitude=request('longitude');
                $station->description=request('description');
                $station->save();

            }

            return response()->json($printedToast,200);

        }

    }

   // Toast timeline(for the mobile app)
    public function toastTimeLine(){

        foreach (Auth::user()->specialties as $specialty)
            $specialties[] = $specialty->id;

        return $tournaments = Toast::with(['users'=>function($query){
            // $query->addSelect(array('toast_id','qr'))
            }])
            ->with(['specialties'=>function($query){
                //$query->addSelect(array('toast_id','comment'))
            }])
            ->with(['specialties.domains'=>function($query){
                //$query->addSelect(array('toast_id','comment'))
            }])
            ->with(['userToasts'=>function($query){
                //$query->addSelect(array('toast_id','comment'))
                $query->where('user_id','=',Auth::user()->id);

            }])
            ->with(['recommendations'=>function($query){
                //$query->addSelect(array('toast_id','comment'))
                $query->where('recommended_id','=',Auth::user()->id);

            }])
            ->whereIn('specialty_id',$specialties)
            ->orderBy('created_at','desc')
            ->orderBy('reaction','desc')
            ->take(50)
            ->get();

    }

   // Like or dislike a toast
    function toastReaction(Request $request){

        if($request->input('reaction') == '1'){

            UserToast::updateOrCreate(
                ['user_id' => Auth::user()->id, 'toast_id' => $request->input('id_toast')],
                ['rate' => 1, 'type' => 'viewed']
            );
            //->where([['user_id','=',Auth::user()->id], ['toast_id','=',$request->input('id_toast')]]);

            DB::table('toasts')->where('id','=',$request->input('id_toast'))->increment('reaction');

            return response()->json(['response'=>'You liked the post'], 200);

        }elseif ($request->input('reaction') == '0'){

            UserToast::updateOrCreate(
                ['user_id' => Auth::user()->id, 'toast_id' => $request->input('id_toast')],
                ['rate' => 0, 'type' => 'viewed']
            )
                ->where([['user_id','=',Auth::user()->id], ['toast_id','=',$request->input('id_toast')]]);

            DB::table('toasts')->where('id','=',$request->input('id_toast'))->decrement('reaction');

            return response()->json(['response'=>'You disliked the post'], 200);

        }

    }

   // Recommand a toast to friends
    public function recommandToast(){

        $recommendation = new Recommendation;

        $recommendation->recommender_id = Auth::user()->id;
        $recommendation->recommended_id = request('recommended_id');
        $recommendation->toast_id = request('toast_id');
        $recommendation->comment = request('comment');
        $result =  $recommendation->save();

        $user = User::find(request('recommended_id'));

        if($user->fcmToken != null) {
            $score = Auth::user()->userName . ' Recommend a toast to you';
            $title = Auth::user()->userName . ' Recommend a toast to you';
            $photo = Auth::user()->photoPath;
            $fcm = new FcmClass($user->fcmToken);
            $fcm->sendToFcm($title, $score, $photo);
        }

        return $result;

    }

   // get recommendation toasts list
    public function recommendedToastsList(){

            return $tournaments = Recommendation::with(['toasts'=>function($query){
                 // $query->addSelect(array('toast_id','qr'))
            }])
            ->with(['users'=>function($query){
                // $query->select(array('userName'));
            }])
            ->where('recommended_id','=',Auth::user()->id)
            ->orderBy('created_at','desc')
            ->get();

    }

   // get recommended toast
    public function recommendedToast($id){

        return $toast = Toast::with(['userToasts'=>function($query){
            $query->where('user_id','=',Auth::user()->id);
        }])
        ->with(['users'=>function($query){
                // $query->addSelect(array('toast_id','qr'))
        }])
        ->with(['specialties'=>function($query){
            //$query->addSelect(array('toast_id','comment'))
        }])
        ->with(['specialties.domains'=>function($query){
            //$query->addSelect(array('toast_id','comment'))
        }])
        ->where('id','=',$id)
        ->get();

    }

    public function shareToast(Request $request){

      $result =  $request->all();
        $share = new Share;
        $share->link = $result['link'];
        $share->toast_id = $result['toast']['id'];
        $result =  $share->save();

        return response()->json(['response'=>$result], 200);

    }

    // save a toast as viewed
    public function toastViewed($id, Request $request){

       $request = $request->all();

       $user_toast =  UserToast::firstOrCreate(['user_id' => Auth::user()->id, 'toast_id' => $id], ['type' => 'viewed']);

        Device::firstOrCreate(['user_toast_id' => $user_toast->id],['os_version' => $request['osVersion'], 'api_version' => $request['apiVersion'],
            'device' => $request['device'], 'model' => $request['model']]);

        return response()->json(['response'=>'ok'], 200);

    }

   // test method
    public function test(){

         $user = User::where('id', '=', 304283208)->first();

 foreach ($user->specialties as $specialty)
     $specialties[] = $specialty->id;

return $tournaments = User::whereHas('toasts' ,function($query){
      $query->whereIn('specialty_id', [6]);

 })
 ->with(['toasts.userToasts'=>function($query){
     //  $query->whereIn('specialty_id', [6]);
     $query->addSelect(array('toast_id','qr'))
           ->where('user_id','=',2085411647);
 }])
 ->with(['toasts.recommendations'=>function($query){
     //  $query->whereIn('specialty_id', [6]);
     $query->addSelect(array('toast_id','comment'))
         ->where('recommended_id','=',2085411647);
 }])->get();

        /*return $data = Toast::with(['users'])
                      ->where('specialty_id','=',9)
                      ->get();*/

    }

}
