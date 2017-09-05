<?php

namespace App\Http\Controllers;

use App\UserRider;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserriderController extends Controller
{
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

        $shareCode = $request->get('shareCode');
        $firstRide = $request->get('firstRide');
        $token = $request->get('token');
        $freelancer = $request->get('freelancer');
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



            $user->shareCode = $shareCode;
            $user->firstRide = $firstRide;

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
        $userRider->shareCode = $shareCode;
        $userRider->firstRide = $firstRide;
        $userRider->token = $token;
        $userRider->freelancer = $freelancer;
        $userRider->status = "pending";
        $userRider->save();
        return response()->json([
            'result' => 'success',
            'userdata' => $userRider,
        ]);
    }
}
