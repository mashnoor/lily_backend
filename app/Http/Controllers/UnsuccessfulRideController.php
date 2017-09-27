<?php

namespace App\Http\Controllers;

use App\UnsuccessfulRide;
use App\UnsuccessfulRideType;
use Illuminate\Http\Request;

class UnsuccessfulRideController extends Controller
{

    function setUnsuccessfulRide(Request $request)
    {
        //1 --> byRider, 2-->byCustomer, 3-->byRiderNotFound
        $customerId = $request->get("customerid", null);
        $riderId = $request->get("riderid", null);
        $causeType = $request->get("causetype");
        $unsuccessfulridetype = new UnsuccessfulRideType();


        if ($causeType == "1") {
            $unsuccessfulridetype->byCustomer = "0";
            $unsuccessfulridetype->byRider = "1";
            $unsuccessfulridetype->noRideFound = "0";
            $unsuccessfulridetype->save();
            $unsuccessfulridetype_id = $unsuccessfulridetype->id;

            $unsuccessfulride = new UnsuccessfulRide();
            $unsuccessfulride->userCustomer_id = $customerId;
            $unsuccessfulride->userRider_id = $riderId;
            $unsuccessfulride->unsuccessfullRideType_id = $unsuccessfulridetype_id;
            $unsuccessfulride->date = date("Y-m-d");
            $unsuccessfulride->save();
            return response()->json([
                "response"=>"success",
                "unsuccessfulridedetail"=>$unsuccessfulride
            ]);


        } else if ($causeType == "2") {
            $unsuccessfulridetype->byCustomer = "1";
            $unsuccessfulridetype->byRider = "0";
            $unsuccessfulridetype->noRideFound = "0";
            $unsuccessfulridetype->save();
            $unsuccessfulridetype_id = $unsuccessfulridetype->id;

            $unsuccessfulride = new UnsuccessfulRide();
            $unsuccessfulride->userCustomer_id = $customerId;
            $unsuccessfulride->userRider_id = $riderId;
            $unsuccessfulride->unsuccessfullRideType_id = $unsuccessfulridetype_id;
            $unsuccessfulride->date = date("Y-m-d");
            $unsuccessfulride->save();
            return response()->json([
                "response"=>"success",
                "unsuccessfulridedetail"=>$unsuccessfulride
            ]);


        } else if ($causeType == "3") {
            $unsuccessfulridetype->byCustomer = "0";
            $unsuccessfulridetype->byRider = "0";
            $unsuccessfulridetype->noRideFound = "1";
            $unsuccessfulridetype->save();
            $unsuccessfulridetype_id = $unsuccessfulridetype->id;

            $unsuccessfulride = new UnsuccessfulRide();
            $unsuccessfulride->userCustomer_id = $customerId;
            $unsuccessfulride->unsuccessfullRideType_id = $unsuccessfulridetype_id;
            $unsuccessfulride->date = date("Y-m-d");
            $unsuccessfulride->save();
            return response()->json([
                "response"=>"success",
                "unsuccessfulridedetail"=>$unsuccessfulride
            ]);


        }





    }
}
