<?php

namespace App\Http\Controllers;

use App\Constant;
use App\History;
use App\UnsuccessfulRide;
use App\UnsuccessfulRideType;
use App\UserCustomer;
use App\UserRider;

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
        return view('constants', ['constants' => $cons]);
    }


    function search_at_Customer_rides(Request $request)
    {

        $output = "";

        $usrs = UserCustomer::where("name", "=", $request->search)->get();
        $users_id = UserCustomer::where("id", "=", $request->search)->get();
        foreach ($users_id as $usr_id) {
            $usrs->push($usr_id);
        }
        $users_phone = UserCustomer::where("phone", "=", $request->search)->get();
        foreach ($users_phone as $usr_id) {
            $usrs->push($usr_id);
        }
        $user_email = UserCustomer::where("email", "=", $request->search)->get();

        foreach ($user_email as $usr_id) {
            $usrs->push($usr_id);
        }

        $user_shareCode = UserCustomer::where("shareCode", "=", $request->search)->get();

        foreach ($user_shareCode as $usr_id) {
            $usrs->push($usr_id);
        }


        $users = array();

        foreach ($usrs as $usr) {
            $usersWhoRide = History::where('userCustomer_id', "=", $usr->id)->count();
            $curr_user = $usr;
            $curr_user['cnt'] = $usersWhoRide;
            array_push($users, $curr_user);
        }


        return view('customerrides')->with('users', $users);


    }


    function UserCustomerProfile($id)
    {
        //$user = UserCustomer::find($name);
        $user = UserCustomer::where('id', '=', $id)->get();
        $userHistory = History::where('userCustomer_id', '=', $id)->get();

        return view('usercustomerprofile')->with('user', $user)->with('userHistory', $userHistory);


    }

    public function UserRiders()
    {
        $UserRiders = UserRider::all();

        return view('userriders', compact("UserRiders"));
    }


    function search_at_User_Riders(Request $request)
    {

        $output = "";
        //    $users = UserCustomer::where("roll", "=", $request->search)->get();
        $UserRiders = UserRider::where("name", "=", $request->search)->get();
        $users_id = UserRider::where("id", "=", $request->search)->get();
        foreach ($users_id as $usr_id) {
            $UserRiders->push($usr_id);
        }
        $users_phone = UserRider::where("phone", "=", $request->search)->get();
        foreach ($users_phone as $usr_id) {
            $UserRiders->push($usr_id);
        }
        $user_email = UserRider::where("email", "=", $request->search)->get();

        foreach ($user_email as $usr_id) {
            $UserRiders->push($usr_id);
        }

        $user_shareCode = UserRider::where("shareCode", "=", $request->search)->get();

        foreach ($user_shareCode as $usr_id) {
            $UserRiders->push($usr_id);
        }


        return view('userriders')->with('UserRiders', $UserRiders);
    }

    function userRidersProfile($id)
    {

        $user = UserRider::where('id', '=', $id)->get();
        $userHistory = History::where('userRider_id', '=', $id)->get();


        return view('userriderprofile')->with('user', $user)->with('userHistory', $userHistory);


    }

    function updateRidesStatus(Request $request)
    {

        $rider = UserRider::find($request->id);
        if ($rider->status == "1") {
            $rider->status = "0";
        } else {
            $rider->status = "1";
        }
        $rider->update();

        return redirect()->back()->with('message', 'rider status updated');
    }


    function bannedRiders()
    {

        $bannedRiders = UserRider::where('status', '=', "0")->get();
        return view('bannedriders')->with('bannedRiders', $bannedRiders);
    
}
    function history()
    {

        $histories = History::all();

        return view('history')->with('histories',$histories);
    }

    function getMoney()
    {


    }

   public function searchHistory(Request $fromDate) {

 
    // $from = $fromDate->date;
    // $to= $fromDate->date1;

    $from = "2017-09-01";

    $to = "2017-11-02";

          $histories = History::whereBetween('date', [$from, $to])->get();
          return view('history')->with('histories',$histories); 
}


}