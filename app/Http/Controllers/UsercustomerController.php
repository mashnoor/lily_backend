<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserCustomer;

class UsercustomerController extends Controller
{
    function singup(Request $request)
    {
        $name = $request->get('name');
        $phone = $request->get('phone');
        $picture = $request->get('picture');
        $date = $request->get('date');
        $shareCode = $request->get('shareCode');
        $firstRide = $request->get('firstRide');
        $token = $request->get('token');
        $userCustomer = new UserCustomer();
        $userCustomer->name = $name;
        $userCustomer->phone = $phone;
        $userCustomer->picture = $picture;
        $userCustomer->date = $date;
        $userCustomer->shareCode = $shareCode;
        $userCustomer->firstRide = $firstRide;
        $userCustomer->token = $token;
        return response()->json([
            'result'=>'success',
        ]);
    }
}
