<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\UserCustomer;

class UsercustomerController extends Controller
{
    function generateRandomString($length = 10) {
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
        $picture = $request->get('picture');
        $email = $request->get('email');


        $firstRide = $request->get('firstRide');
        $token = $request->get('token');
        $address = $request->get('address');

        $user = UserCustomer::where("phone", $phone)->first();
        if (!is_null($user)) {
            //If user exists, update token
            $user->token = $token;
            $user->name = $name;
            $user->email = $email;
            $user->picture = $picture;


            if(!$user->firstRide == "0")
            {
                $user->firstRide = $firstRide;
            }

            $user->address = $address;
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
        $userCustomer->date = date("Y-m-d");
        $userCustomer->shareCode = $this->generateRandomString(6);
        $userCustomer->firstRide = $firstRide;
        $userCustomer->token = $token;
        $userCustomer->address = $address;
        $userCustomer->save();
        return response()->json([
            'result' => 'success',
            'userdata'=>$userCustomer,
        ]);
    }

    function getCustomerProfile(Request $request)
    {
        $phone = $request->get('phone');
        $token = $request->get('token');
        $user = UserCustomer::where("phone", $phone)
            ->where('token', $token)->first();
        if(is_null($user))
        {
            return response()->json([
                "response" => "couldn't find customer profile",
            ]);
        }
        else
        {
            return response()->json([
                'result' => 'success',
                'userdata'=>$user,
            ]);
        }


    }
}
