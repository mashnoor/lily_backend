<?php

namespace App\Http\Controllers;

use App\Complain;
use Illuminate\Http\Request;

class ComplainController extends Controller
{
    function setComplain(Request $request)
    {
        $message = $request->get("message");
        $userCustomer_id = $request->get("userCustomer_id");
        $userRider_id = $request->get("userRider_id");
        $complain = new Complain();
        $complain->message = $message;
        $complain->userCustomer_id = $userCustomer_id;
        $complain->userRider_id = $userRider_id;
        $complain->save();
        return response()->json([
            "response" => "complain added successfully",
        ]);


    }
}
