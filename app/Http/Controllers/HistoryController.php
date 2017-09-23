<?php

namespace App\Http\Controllers;

use App\History;
use App\UserCustomer;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    function getHistory(Request $request)
    {
        $token = $request->get('token');
        $userCustomer = UserCustomer::where('token', $token)->first();
        if(is_null($userCustomer))
        {
            return response()->json([
               "result" => "user not found"
            ]);
        }
        else
        {
            $userId = $userCustomer->id;
            $histories = History::where('userCustomer_id', $userId)->get();
            return $histories;
        }

    }

    function setHistory(Request $request)
    {

    }
}
