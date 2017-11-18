<?php

namespace App\Http\Controllers;

use App\Constant;
use App\History;
use App\UnsuccessfulRide;
use App\UnsuccessfulRideType;
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
        foreach ($usersWhoRide as $user) {
            $currUser = UserCustomer::where('id', '=', $user->userCustomer_id)->first();
            $currUser['cnt'] = $user->cnt;
            array_push($users, $currUser);
        }


        return view('customerrides', ['users' => $users]);


    }

    function getEarnings()
    {
        $totalFare = DB::table('history')->select(DB::raw('SUM(fare) AS totalFare'))->get();
        $riderPercent = DB::table('history')->select(DB::raw('SUM(riderPercent) AS totalRider'))->get();
        $companyPercent = DB::table('history')->select(DB::raw('SUM(companyPercent) AS companyPercent'))->get();
        //return $totalFare[0]->totalFare;

        return view('earnings', ['totalFare' => $totalFare[0]->totalFare, 'riderPercent' => $riderPercent[0]->totalRider, 'companyPercent' => $companyPercent[0]->companyPercent]);
    }

    function getUnsuccessfulRides()
    {
        $todayDate = date("Y-m-d");
        $todayUnsuccessfulRides = UnsuccessfulRide::where('date', '=', $todayDate)->get();
        $todayUnsuccessfulRides_modified = array();
        $totalUnsuccessfulToday = count($todayUnsuccessfulRides);
        foreach ($todayUnsuccessfulRides as $todayUnsuccessfulRide) {
            $rideType = UnsuccessfulRideType::where('id', '=', $todayUnsuccessfulRide->unsuccessfullRideType_id)->first();
            $reason = "blank";
            if ($rideType->byCustomer == "00000000001")
                $reason = "Canceled by Customer";
            else if ($rideType->byRider)
                $reason = "Canceled by Rider";
            else
                $reason = "Rider not found";

            $todayUnsuccessfulRide['reason'] = $reason;
            array_push($todayUnsuccessfulRides_modified, $todayUnsuccessfulRide);
        }

        $allUnsuccessfulRides = UnsuccessfulRide::all();
        $allUnsuccessfulRide_modified = array();
        $totalUnsuccessful = count($allUnsuccessfulRides);
        foreach ($allUnsuccessfulRides as $allUnsuccessfulRide) {
            $rideType = UnsuccessfulRideType::where('id', '=', $allUnsuccessfulRide->unsuccessfullRideType_id)->first();
            $reason = "blank";
            if ($rideType->byCustomer == "00000000001")
                $reason = "Canceled by Customer";
            else if ($rideType->byRider == "00000000001")
                $reason = "Canceled by Rider";
            else
                $reason = "Rider not found";

            $allUnsuccessfulRide['reason'] = $reason;
            array_push($allUnsuccessfulRide_modified, $allUnsuccessfulRide);
        }
        return view('unsuccessfulrides', ['toadyUnsuccessfuls' => $todayUnsuccessfulRides_modified,
            'date' => $todayDate,
            'totalUnsuccessfulToday' => $totalUnsuccessfulToday,
            'allunsuccessfulrides' => $allUnsuccessfulRide_modified,
            'totalUnsuccessful' => $totalUnsuccessful
        ]);
    }

    function getConstants()
    {
        $cons = Constant::all();
        return view('constants', ['constants'=>$cons]);
    }
}
