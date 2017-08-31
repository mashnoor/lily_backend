<?php

namespace App\Http\Controllers;

use App\UserRider;
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

        $userPic = $request->get('userPic');
        $date = $request->get('date');
        $shareCode = $request->get('shareCode');
        $firstRide = $request->get('firstRide');
        $token = $request->get('token');
        $user = UserRider::where("phone", $phone)->first();
        if (!is_null($user)) {
            //If user exists, update token
            $user->token = $token;
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
        $userRider->licenseNO = $licenseNO;
        $userRider->registrationNO = $registrationNO;
        $userRider->licensePic = $licensePic;
        $userRider->registrationPic = $registrationPic;
        $userRider->registrationPic = $registrationPic;
        $userRider->userPic = $userPic;
        $userRider->date = $date;
        $userRider->shareCode = $shareCode;
        $userRider->firstRide = $firstRide;
        $userRider->token = $token;
        $userRider->save();
        return response()->json([
            'result' => 'success',
            'userdata'=>$userRider,
        ]);
    }
}
