<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\ProviderDevice;
use Exception;
use Log;
use Setting;

use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;


class SendPushNotification extends Controller
{
	/**
     * New Ride Accepted by a Driver.
     *
     * @return void
     */
    public function RideAccepted($request){

    	return $this->sendPushToUser($request->user_id, trans('api.push.request_accepted'));
    }

    /**
     * Driver Arrived at your location.
     *
     * @return void
     */
    public function user_schedule($user){

        return $this->sendPushToUser($user, trans('api.push.schedule_start'));
    }

    /**
     * New Incoming request
     *
     * @return void
     */
    public function provider_schedule($provider){

        return $this->sendPushToProvider($provider, trans('api.push.schedule_start'));

    }

    /**
     * New Ride Accepted by a Driver.
     *
     * @return void
     */
    public function UserCancellRide($request){

        return $this->sendPushToProvider($request->provider_id, trans('api.push.user_cancelled'));
    }


    /**
     * New Ride Accepted by a Driver.
     *
     * @return void
     */
    public function ProviderCancellRide($request){

        return $this->sendPushToUser($request->user_id, trans('api.push.provider_cancelled'));
    }

    /**
     * Driver Arrived at your location.
     *
     * @return void
     */
    public function Arrived($request){

        return $this->sendPushToUser($request->user_id, trans('api.push.arrived'));
    }

     /**
     * Driver Arrived at your location.
     *
     * @return void
     */
    public function Dropped($request){

        Log::info( trans('api.push.dropped').Setting::get('currency').$request->payment->total.' by '.$request->payment_mode);

        return $this->sendPushToUser($request->user_id, trans('api.push.dropped').Setting::get('currency').$request->payment->total.' by '.$request->payment_mode);
    }

    /**
     * Money added to user wallet.
     *
     * @return void
     */
    public function ProviderNotAvailable($user_id){

        return $this->sendPushToUser($user_id,trans('api.push.provider_not_available'));
    }

    /**
     * New Incoming request
     *
     * @return void
     */
    public function IncomingRequest($provider){

        return $this->sendPushToProvider($provider, trans('api.push.incoming_request'));

    }
    

    /**
     * Driver Documents verfied.
     *
     * @return void
     */
    public function DocumentsVerfied($provider_id){

        return $this->sendPushToProvider($provider_id, trans('api.push.document_verfied'));
    }


    /**
     * Money added to user wallet.
     *
     * @return void
     */
    public function WalletMoney($user_id, $money){

        return $this->sendPushToUser($user_id, $money.' '.trans('api.push.added_money_to_wallet'));
    }

    /**
     * Money charged from user wallet.
     *
     * @return void
     */
    public function ChargedWalletMoney($user_id, $money){

        return $this->sendPushToUser($user_id, $money.' '.trans('api.push.charged_from_wallet'));
    }

    /**
     * Sending Push to a user Device.
     *
     * @return void
     */
    public function sendPushToUser($user_id, $push_message){

    	try{

	    	$user = User::findOrFail($user_id);

            if($user->device_token != ""){

                \Log::info('sending push for user : '. $user->first_name);

                $this->sendFcmToSingleDevice($user->device_token,Setting::get('site_title'),$push_message);
    	    	if($user->device_type == 'ios'){
                    
    	    		return $this->sendFcmToSingleDevice($user->device_token,Setting::get('site_title'),$push_message);

    	    	}elseif($user->device_type == 'android'){
    	    		
                    return $this->sendFcmToSingleDevice($user->device_token,Setting::get('site_title'),$push_message);


    	    	}
            }

    	} catch(Exception $e){
    		return $e;
    	}

    }

    /**
     * Sending Push to a user Device.
     *
     * @return void
     */
    public function sendPushToProvider($provider_id, $push_message){

    	try{
	    	$provider = ProviderDevice::where('provider_id',$provider_id)->with('provider')->first();

            if($provider->token != ""){
                
                \Log::info('sending push for provider : '. $provider->provider->first_name);

            	if($provider->type == 'ios'){

                    return $this->sendFcmToSingleDevice($provider->device_token,Setting::get('site_title'),$push_message);


            	}elseif($provider->type == 'android'){
            		
                    return $this->sendFcmToSingleDevice($provider->device_token,Setting::get('site_title'),$push_message);

            	}
            }

    	} catch(Exception $e){
    		return $e;
    	}

    }

    public function sendFcmToSingleDevice($token = null, $title = 'Notification title', $body = 'Notification body', $data = '') {
        Log::debug(__FILE__ . " " . __LINE__);
        if (empty($token)) return false;
        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60 * 20);

        Log::debug(__LINE__);
        $notificationBuilder = new PayloadNotificationBuilder($title);
        $notificationBuilder->setBody($body)
                ->setSound('default');
        Log::debug(__LINE__);

        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData(['data' => $data]);

        $option = $optionBuilder->build();
        $notification = $notificationBuilder->build();
        $data = $dataBuilder->build();
        Log::debug(__LINE__);

        $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);
        Log::debug("resp: " . print_r($downstreamResponse, true));
        Log::debug("s: " . $downstreamResponse->numberSuccess() . " f: " . $downstreamResponse->numberFailure() .
                " m: " . $downstreamResponse->numberModification());
        $downstreamResponse->numberSuccess();
        $downstreamResponse->numberFailure();
        $downstreamResponse->numberModification();
        Log::debug(__LINE__);


        // return Array - you must remove all this tokens in your database
        $downstreamResponse->tokensToDelete();

        // return Array (key : oldToken, value : new token - you must change the token in your database)
        $downstreamResponse->tokensToModify();

        // return Array - you should try to resend the message to the tokens in the array
        $downstreamResponse->tokensToRetry();
        Log::debug(__LINE__);

        // return Array (key:token, value:error) - in production you should remove from your database the tokens
        $downstreamResponse->tokensWithError();
    }

    public function sendFcmToMultipleDevices($tokens = [], $title = 'Notification title', $body = 'Notification body', $data = '') {

        if (empty($tokens)) return false;
        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60 * 20);

        $notificationBuilder = new PayloadNotificationBuilder($title);
        $notificationBuilder->setBody($body)->setSound('default');

        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData(['data' => $service_id]);

        $option = $optionBuilder->build();
        $notification = $notificationBuilder->build();
        $data = $dataBuilder->build();

        $downstreamResponse = FCM::sendTo($tokens, $option, $notification, $data);
        $downstreamResponse->numberSuccess();
        $downstreamResponse->numberFailure();
        $downstreamResponse->numberModification();
        // return Array - you must remove all this tokens in your database
        $downstreamResponse->tokensToDelete();
        // return Array (key : oldToken, value : new token - you must change the token in your database)
        $downstreamResponse->tokensToModify();
        // return Array - you should try to resend the message to the tokens in the array
        $downstreamResponse->tokensToRetry();
        $downstreamResponse->tokensWithError();
        }

}
