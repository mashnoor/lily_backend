<?php

namespace App\Http\Controllers;

use App\NoticeBoard;
use Illuminate\Http\Request;

class NoticeboardController extends Controller
{
    function getNoticeBoard($cusType)
    {
        //0 for rider, 1 for customer
        if($cusType == "rider")
        {
            return NoticeBoard::where('reciverType', '=', '0')->get();
        }
        else if($cusType == "customer")
        {
            return NoticeBoard::where('reciverType', '=', '1')->get();
        }
        else
        {
            return response()->json([
               'response' => 'invalid get parameter'
            ]);
        }
    }
}
