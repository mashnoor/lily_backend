<?php

namespace App\Http\Controllers;

use App\SpecificNoticeBoard;
use Illuminate\Http\Request;

class SpecificNoticeBoardController extends Controller
{
    function getNotice(Request $request)
    {
        $id = $request->get('id');
        $who = $request->get('who');
        if($who == "rider")
        {
            return SpecificNoticeBoard::where('userRider_id', '=', $id)->get();
        }
        else if($who == "customer")
        {
            return SpecificNoticeBoard::where('userCustomer_id', '=', $id)->get();
        }
        else
        {
            return response()->json([
               "response" => "not found"
            ]);
        }
    }
}
