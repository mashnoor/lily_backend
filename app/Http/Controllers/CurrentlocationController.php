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
        if (!is_null($prevLocation)) {
            $prevLocation->userCustomer_id = $userCustomer_id;

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
            "response" => "current location stored successfully",
        ]);

    }

    function distance($lat1, $lon1, $lat2, $lon2, $unit)
    {

        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper($unit);

        if ($unit == "K") {
            return ($miles * 1.609344);
        } else if ($unit == "N") {
            return ($miles * 0.8684);
        } else {
            return $miles;
        }
    }

    function getFreeRiders(Request $request)
    {
        $token = $request->get('token');
        $lat = $request->get('lat');
        $lng = $request->get('lng');
        $userCustomer = UserCustomer::where('token', '=', $token)->first();
        if (is_null($userCustomer)) {
            return response()->json([
                "response" => "token didn't match"
            ]);
        }
        $currentFreeRiders = CurrentLocation::where('free', '=', '1')->get();
        $sendRiders = array();
        foreach ($currentFreeRiders as $currentFreeRider)
        {
            $curr_lat = $currentFreeRider->lat;
            $curr_lng = $currentFreeRider->lng;
            $distance = $this->distance($lat, $lng, $curr_lat, $curr_lng, "K");

            if(doubleval($distance)<=1.5)
            {
                array_push($sendRiders, $currentFreeRider);
            }


        }
        return $sendRiders;
    }

}
