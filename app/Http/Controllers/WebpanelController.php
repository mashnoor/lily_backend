<?php

namespace App\Http\Controllers;

use App\History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WebpanelController extends Controller
{
    function getDashboard()
    {
        //Send Most Active Days and Most active hours
        $histories = History::all();
        $all_hours = array();
        for ($i = 0; $i < 24; $i++) {
            array_push($all_hours, 0);
        }
        foreach ($histories as $history) {
            $curr_hour = intval($history->hour);
            $all_hours[$curr_hour]++;
        }
        $mostActivehour = -1;
        $mostOccur = -1;
        for ($i = 0; $i < 24; $i++) {
            if ($all_hours[$i] > $mostOccur) {
                $mostActivehour = $i;
                $mostOccur = $all_hours[$i];
            }
        }
        return view('dashboard');


    }
    function getMostActiveUsers()
    {
        /***

        return DB::table('history')->select('userCustomer_id', DB::raw('COUNT(userCustomer_id) AS occurrences'))

            ->orderBy('occurrences', 'DESC')
            ->limit(10)
            ->get();
         * ***/
        return view('customerrides');


    }
    function getEarnings()
    {
        return view('earnings');
    }
}
