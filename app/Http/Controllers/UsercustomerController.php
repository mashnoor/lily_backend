<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserCustomer;

class UsercustomerController extends Controller
{
    function signup(Request $request)
    {
        $name = $request->get('name');
        $phone = $request->get('phone');
        $picture = $request->get('picture');
        $date = $request->get('date');
        $shareCode = $request->get('shareCode');
        $firstRide = $request->get('firstRide');
        $token = $request->get('token');
        $user = UserCustomer::where("phone", $phone)->first();
        if(!is_null($user))
        {
            //If user exists, update token
            $user->token = $token;
            $user->save();
            return response()->json([
               'result'=>'User already exists',
            ]);
        }

        $userCustomer = new UserCustomer();
        $userCustomer->name = $name;
        $userCustomer->phone = $phone;
        $userCustomer->picture = $picture;
        $userCustomer->date = $date;
        $userCustomer->shareCode = $shareCode;
        $userCustomer->firstRide = $firstRide;
        $userCustomer->token = $token;
        $userCustomer->save();
        return response()->json([
            'result'=>'success',
        ]);
    }
}
