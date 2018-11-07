<?php
/**
 * Created by PhpStorm.
 * User: Bachir
 * Date: 05/05/2018
 * Time: 11:01
 */

namespace App\Algorithms;

use Illuminate\Http\Request;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use LaravelFCM\Facades\FCM;


class FcmClass
{

    /**
     * FcmTokenController constructor.
     */
    public function __construct($fcmToken)
    {
        global $token;
        $token = $fcmToken;
    }

    public function sendToFcm($title, $score, $photo){

        global $token;

        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60*20);

        $notificationBuilder = new PayloadNotificationBuilder($title.'');
        //$notificationBuilder->setBody($score.'')
        //->setSound('default');

        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData(['title' => $title])
                    ->addData(['score' => $score])
                    ->addData(['photo' => $photo]);

        $option = $optionBuilder->build();
        $notification = $notificationBuilder->build();
        $data = $dataBuilder->build();

        $downstreamResponse = FCM::sendTo($token, $option,$notification,$data);

        $downstreamResponse->numberSuccess();
        $downstreamResponse->numberFailure();
        $downstreamResponse->numberModification();

//return Array - you must remove all this tokens in your database
        $downstreamResponse->tokensToDelete();

//return Array (key : oldToken, value : new token - you must change the token in your database )
        $downstreamResponse->tokensToModify();

//return Array - you should try to resend the message to the tokens in the array
        $downstreamResponse->tokensToRetry();

// return Array (key:token, value:errror) - in production you should remove from your database the tokens

    }

}
