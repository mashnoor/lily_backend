<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\UserCustomer;

class UsercustomerController extends Controller
{
    function signup(Request $request)
    {
        $name = $request->get('name');
        $phone = $request->get('phone');
        $picture = $request->get('picture');
        $email = $request->get('email');

        $shareCode = $request->get('shareCode');
        $firstRide = $request->get('firstRide');
        $token = $request->get('token');
        $user = UserCustomer::where("phone", $phone)->first();
        if (!is_null($user)) {
            //If user exists, update token
            $user->token = $token;
            $user->name = $name;
            $user->email = $email;
            $user->picture = $picture;
            $user->date = Carbon::now();
            $user->shareCode = $shareCode;
            $user->firstRide = $firstRide;
            $user->save();
            return response()->json([
                'result' => 'User already exists',
                'userdata' => $user,
            ]);
        }

        $userCustomer = new UserCustomer();
        $userCustomer->name = $name;
        $userCustomer->phone = $phone;
        $userCustomer->picture = $picture;
        $userCustomer->email = $email;
        $userCustomer->date = Carbon::now()->toDateTimeString();
        $userCustomer->shareCode = $shareCode;
        $userCustomer->firstRide = $firstRide;
        $userCustomer->token = $token;
        $userCustomer->save();
        return response()->json([
            'result' => 'success',
            'userdata'=>$userCustomer,
        ]);
    }
}
