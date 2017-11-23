<?php

namespace App\Http\Controllers;

use App\Constant;
use App\Rating;
use App\UserCustomer;
use App\UserRider;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserriderController extends Controller
{
    function generateRandomString($length = 10)
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    function signup(Request $request)
    {
        $name = $request->get('name');
        $phone = $request->get('phone');
        $nidNumber = $request->get('nidNumber');
        $licenseNO = $request->get('licenseNO');
        $registrationNO = $request->get('registrationNO');
        $licensePic = $request->get('licensePic');
        $registrationPic = $request->get('registrationPic');
        $email = $request->get('email');
        $userPic = $request->get('userPic');


        $firstRide = $request->get('firstRide');
        $token = $request->get('token');
        $freelancer = $request->get('freelancer');
        $address = $request->get('address');
        $status = $request->get('status');
        $user = UserRider::where("phone", $phone)->first();
        if (!is_null($user)) {
            //If user exists, update token
            $user->token = $token;
            $user->name = $name;
            $user->nidNumber = $nidNumber;
            $user->licenseNO = $licenseNO;
            $user->registrationNO = $registrationNO;
            $user->licensePic = $licensePic;
            $user->registrationPic = $registrationPic;
            $user->userPic = $userPic;
            $user->email = $email;
            $user->status = $status;


            $user->firstRide = $firstRide;
            $user->address = $address;
            $user->moneyDue = "0";

            $user->save();
            return response()->json([
                'result' => 'User already exists',
                'userdata' => $user,
            ]);
        }

        $userRider = new UserRider();

        $userRider->name = $name;
        $userRider->phone = $phone;
        $userRider->nidNumber = $nidNumber;
        $userRider->email = $email;
        $userRider->licenseNO = $licenseNO;
        $userRider->registrationNO = $registrationNO;
        $userRider->licensePic = $licensePic;
        $userRider->registrationPic = $registrationPic;
        $userRider->registrationPic = $registrationPic;
        $userRider->userPic = $userPic;
        $userRider->date = date("Y-m-d");
        $userRider->shareCode = $this->generateRandomString(6);
        $userRider->firstRide = $firstRide;
        $userRider->token = $token;
        $userRider->freelancer = $freelancer;
        $userRider->status = $status;
        $userRider->address = $address;

        $userRider->save();
        return response()->json([
            'result' => 'success',
            'userdata' => $userRider,
        ]);
    }

    function getRiderProfileByPhone(Request $request)
    {
        $phone = $request->get('riderphone');
        $userRider = UserRider::where('phone', $phone)->first();
        if (is_null($userRider)) {
            return response()->json([
                'response' => 'rider not found'
            ]);
        } else {
            return response()->json([
                'response' => 'success',
                'userdata' => $userRider
            ]);
        }
    }

    public static function getRiderRating($id)
    {
        $ratings = Rating::where('userRider_id', $id)->where('rateBy', '=', '1')->get();
        $main_rating = 0.0;
        if (count($ratings) < 1) {
            return $main_rating;
        }
        foreach ($ratings as $rating) {
            $main_rating += doubleval($rating->value);

        }
        return $main_rating / doubleval(count($ratings));

    }

    function applyShareCode(Request $request)
    {
        $rider_token = $request->get('rider_token');
        $shareCode = $request->get('share_code');
        $userRider = UserRider::where('token', '=', $rider_token)->first();
        $riderShareAmount = Constant::where('variable', '=', 'ridershareamount')->first();
        $riderShareAmount = doubleval($riderShareAmount->value);
        if ($userRider->firstRide != "1") {
            return response()->json([
                "response" => "not first ride"
            ]);
        }
        $anotherUserRider = UserRider::where('shareCode', '=', $shareCode)->first();
        if (is_null($anotherUserRider)) {
            return response()->json([
                "response" => "not valid share code"
            ]);
        }
        $userRider->moneyDue = doubleval($userRider->moneyDue) - $riderShareAmount;
        $userRider->firstRide = "0";
        $userRider->appliedShareCode = $shareCode;
        $userRider->save();

        $anotherUserRider->moneyDue = doubleval($anotherUserRider->moneyDue) - $riderShareAmount;
        $anotherUserRider->save();
        return response()->json([
            "response" => "successfully applied share code",
            "value" => $riderShareAmount
        ]);


    }

    function getRiderProfile(Request $request)
    {
        $riderId = $request->get('riderid');
        $customerToken = $request->get('customertoken');
        $userCustomer = UserCustomer::where("token", $customerToken)->first();
        if (is_null($userCustomer)) {
            return response()->json([
                "response" => "couldn't find rider",
            ]);
        } else {
            $userRider = UserRider::where('id', $riderId)->first();
            $rating = $this->getRiderRating($userRider->id);
            $userRider->rating = $rating;
            return response()->json([
                'response' => 'success',
                'userdata' => $userRider,

            ]);
        }


    }
    function getMoneyDue(Request $request)
    {
        $riderToken = $request->get('ridertoken');
        $userRider = UserRider::where('token', '=', $riderToken)->first();
        if(is_null($userRider))
        {
            return response()->json([
               'response' => 'token not valid'
            ]);
        }
        else
        {
            return $userRider;
        }
    }
}
