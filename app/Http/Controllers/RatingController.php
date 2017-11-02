<?php

namespace App\Http\Controllers;

use App\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    function setRating(Request $request)
    {
        $customerId = $request->get('customer_id');
        $riderId = $request->get('rider_id');
        $value = $request->get('value');
        $ratedBy = $request->get('rate_by'); // 0 for rider, 1 for customer
        $history_id = $request->get('history_id');


        $rating = new Rating();
        $rating->userCustomer_id = $customerId;
        $rating->userRider_id = $riderId;
        $rating->value = $value;
        $rating->rateBy = $ratedBy;
        $rating->history_id = $history_id;
        $rating->save();
        return response()->json([
           "response" => "success",
        ]);
    }
}
