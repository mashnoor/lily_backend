<?php

namespace App\Http\Controllers;

use App\UserCustomer;
use App\UserRider;
use Illuminate\Http\Request;

class NotificationController extends Controller
{

    function sendNotfication(Request $request)
    {
        $sender_token = $request->get('sender_token');
        $receiver_token = $request->get('receiver_token');
        $message = $request->get("message");
        $reg_ids = array();
        $userRider_sender = UserRider::where('token', $sender_token)->first();
        $userRider_receiver = UserRider::where('token', $receiver_token)->first();

        $userCustomer_sender = UserCustomer::where('token', $sender_token)->first();
        $userCustomer_receiver = UserCustomer::where('token', $receiver_token)->first();


        $actual_sender = null;
        $actual_receiver = null;
        $rating = 0.0;

        //Find the Actual Sender
        if (is_null($userRider_sender)) {
            if (is_null($userCustomer_sender)) {
                return response()->json([
                    "response" => "sender token invalid"
                ]);
            } else {
                global $actual_sender, $rating;
                $actual_sender = $userCustomer_sender;
                $rating = UsercustomerController::getCustomerRating($actual_sender->id);
            }
        } else {
            global $actual_sender, $rating;
            $actual_sender = $userRider_sender;
            $rating = UserriderController::getRiderRating($actual_sender->id);

        }


        //Find the Actual Receiver
        if (is_null($userRider_receiver)) {
            if (is_null($userCustomer_receiver)) {
                return response()->json([
                    "response" => "receiver token invalid"
                ]);
            } else {
                global $actual_receiver;
                $actual_receiver = $userCustomer_receiver;
            }
        } else {
            global $actual_receiver;
            $actual_receiver = $userRider_receiver;

        }

        array_push($reg_ids, $receiver_token);
        $post = array();
        $post["message"] = $message;
        $post["sender"] = $actual_sender;
        $post["rating"] = $rating;
        return self::sendMessage($reg_ids, $post);


    }

    public static function sendMessage($registrationIds, $post)
    {
        //$registrationIds = array();
        //array_push($registrationIds, "eRUTpiZ5JKY:APA91bFexxwSS1xeRYDHJhOzpdZH8TlN1hFyeTwIMJ-kyRGlJmP4wBSYxvhRmr49gdA48QwGkyb9ytVQtbNZ0E-cK2LxCFIJiALHHg2boPDvY_Xx323Eynrd_-r52Gta2znJgNJG1Apv");
        $firebase_api_key = "AAAAawvJq14:APA91bH8-w8RqCBlJudOxrmFmTkEb6D2a82_omiNKcNGkb4Vja0xaDDLGFxqrE47E0gDyEC-0wNJHT-96tN2qq9V5_XCbmoEu2mB3HDw5mzYgd4-NV8cmbuvwEFLjX9eJS7gf2V8Ovzn";


        $msg = array
        (
            'body' => $post

        );

        $fields = array
        (
            'registration_ids' => $registrationIds,
            'data' => $msg
        );

        $headers = array
        (
            'Authorization: key=' . $firebase_api_key,
            'Content-Type: application/json'
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://android.googleapis.com/gcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;

    }

}
