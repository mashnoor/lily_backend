<?php

namespace App\Http\Controllers;

use App\CurrentLocation;
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
           "currentlocation"=>$currentLocation,
        ]);

    }

}
