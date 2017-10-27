<?php

namespace App\Http\Controllers;

use App\History;
use App\UserCustomer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WebpanelController extends Controller
{
    function getDashboard()
    {
        $hours = DB::table('history')->select('hour', DB::raw('COUNT(*) AS cnt'))
            ->groupBy('hour')
            ->orderBy('cnt', 'DESC')
            ->get();

        return view('dashboard', ["hours" => $hours]);


    }

    function getMostActiveUsers()
    {

        // SELECT *, COUNT(*) AS cnt FROM history GROUP BY userCustomer_id ORDER BY cnt ASC
        $usersWhoRide = DB::table('history')->select('userCustomer_id', DB::raw('COUNT(*) AS cnt'))
            ->groupBy('userCustomer_id')
            ->orderBy('cnt', 'DESC')
            ->get();
        $users = array();
        foreach ($usersWhoRide as $user)
        {
            $currUser = UserCustomer::where('id', '=', $user->userCustomer_id)->first();
            $currUser['cnt'] = $user->cnt;
            array_push($users, $currUser);
        }


        return view('customerrides', ['users'=>$users]);


    }

    function getEarnings()
    {
        $totalFare =  DB::table('history')->select(DB::raw('SUM(fare) AS totalFare'))->get();
        $riderPercent = DB::table('history')->select(DB::raw('SUM(riderPercent) AS totalRider'))->get();
        $companyPercent = DB::table('history')->select(DB::raw('SUM(fare) AS companyPercent'))->get();
        //return $totalFare[0]->totalFare;

        return view('earnings', ['totalFare'=>$totalFare[0]->totalFare, 'riderPercent'=>$riderPercent[0]->totalRider, 'companyPercent'=>$companyPercent[0]->companyPercent]);
    }
}
