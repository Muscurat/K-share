<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use App\Domain;
use Illuminate\Support\Facades\Auth;

class DomainController extends Controller
{
    public function getDomain(){

      // get all domais with specialities
      return   $domains = Domain::with('specialties')->get();

    }

    public function getPhoto($photoPath){

       $filepath = public_path('/Photos/Domains/'.$photoPath.'.jpg');
       return Response::download($filepath);

    }

     public function setInterestPoints(Request $request){

            global $level;
            $level = 0;
 
			$result =  $request->getContent();
			$manage = json_decode($result , true);

			foreach ($manage as $domain) {
				foreach ($domain['specialties'] as $key ) {
					if($key['checked'] == true){

                       if($domain['domain'] == Auth::user()->domain)
						     $level = 5;

						Auth::user()->specialties()->attach($key['id'] , ['level' => 50]);
			            $level = 0;

					}
				}
			    
			}

			echo 'ok';

    }

}
