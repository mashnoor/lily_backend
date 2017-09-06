<?php

namespace App\Http\Controllers;

use App\CurrentLocation;
use App\UserCustomer;
use Illuminate\Http\Request;

class CurrentlocationController extends Controller
{
    function setcurrentlocation(Request $request)
    {

        $userCustomer_id = $request->get('userCustomer_id');
        $userRider_id = $request->get('userRider_id');
        $lat = $request->get('lat');
        $lng = $request->get('lng');
        $rotation = $request->get('rotation');
        $free = $request->get('free');
        $lastOnline = $request->get('lastOnline');

        $prevLocation = CurrentLocation::where('userRider_id', '=', $userRider_id)->first();
        if(!is_null($prevLocation))
        {
            $prevLocation->userRider_id = $userRider_id;
            $prevLocation->lat = $lat;
            $prevLocation->lng = $lng;
            $prevLocation->rotation = $rotation;
            $prevLocation->free = $free;
            $prevLocation->lastOnline = $lastOnline;
            $prevLocation->save();
            return response()->json([
               "response" => "location updated successfully",
            ]);
        }

        $currentLocation = new CurrentLocation();
        $currentLocation->userCustomer_id = $userCustomer_id;
        $currentLocation->userRider_id = $userRider_id;
        $currentLocation->lat = $lat;
        $currentLocation->lng = $lng;
        $currentLocation->rotation = $rotation;
        $currentLocation->free = $free;
        $currentLocation->lastOnline = $lastOnline;
        $currentLocation->save();

        return response()->json([
           "response"=>"current location stored successfully",
        ]);

    }

    function getFreeRiders(Request $request)
    {
        $token = $request->get('token');
        $userCustomer = UserCustomer::where('token', '=', $token)->first();
        if(is_null($userCustomer))
        {
            return response()->json([
                "response" => "token didn't match"
            ]);
        }
        $currentFreeRiders = CurrentLocation::where('free', '=', '1')->get();
        return $currentFreeRiders;
    }

}
