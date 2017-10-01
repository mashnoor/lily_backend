<?php

namespace App\Http\Controllers;

use App\History;
use App\UserCustomer;
use App\UserRider;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    function getHistory(Request $request)
    {
        $token = $request->get('token');
        $userCustomer = UserCustomer::where('token', $token)->first();
        $userRIder= UserRider::where('token', $token)->first();
        if(is_null($userCustomer) && is_null($userRIder))
        {
            return response()->json([
               "response" => "user not found"
            ]);
        }
        else if(is_null($userRIder))
        {
            $userId = $userCustomer->id;
            $histories = History::where('userCustomer_id', $userId)->get();
            return response()->json([
               "response"=>"customer found successfully",
                "histories"=>$histories
            ]);
        }
        else
        {
            $userId = $userRIder->id;
            $histories = History::where('userRider_id', $userId)->get();
            return response()->json([
                "response"=>"rider found successfully",
                "histories"=>$histories
            ]);
        }

    }

    function setHistory(Request $request)
    {
        $userCustomer_id = $request->get('userCustomer_id');
        $origin = $request->get('origin');
        $destination = $request->get('destination');
        $date = date("Y-m-d");
        $hour = $request->get('hour');
        $fare = $request->get('fare');
        $riderPercent = $request->get('riderPercent');
        $companyPercent = $request->get('companyPercent');
        $userRider_id = $request->get('userRider_id');
        $historyId = $request->get('historyId');

        $history = new History();
        $history->userCustomer_id = $userCustomer_id;
        $history->origin = $origin;
        $history->destination = $destination;
        $history->date = $date;
        $history->hour = $hour;
        $history->fare = $fare;
        $history->riderPercent = $riderPercent;
        $history->companyPercent = $companyPercent;
        $history->userRider_id = $userRider_id;
        $history->historyId = $historyId;

        $history->save();

        return response()->json([
           'response' => 'success',
        ]);

    }
}
