<?php

namespace App\Http\Controllers;

use App\Constant;
use App\History;
use App\PromoCode;
use App\PromoUsedByCustomer;
use App\UserCustomer;
use App\UserRider;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    function generateRandomString($length = 10)
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    function getHistory(Request $request)
    {
        $token = $request->get('token');
        $userCustomer = UserCustomer::where('token', $token)->first();
        $userRIder = UserRider::where('token', $token)->first();
        if (is_null($userCustomer) && is_null($userRIder)) {
            return response()->json([
                "response" => "user not found"
            ]);
        } else if (is_null($userRIder)) {
            $userId = $userCustomer->id;
            $histories = History::where('userCustomer_id', $userId)->get();
            return response()->json([
                "response" => "customer found successfully",
                "histories" => $histories
            ]);
        } else {
            $userId = $userRIder->id;
            $histories = History::where('userRider_id', $userId)->get();
            return response()->json([
                "profileStatus" => $userRIder->status,
                "response" => "rider found successfully",
                "histories" => $histories
            ]);
        }

    }

    function getPromoPercent($userCustomerId)
    {
        $promo = PromoUsedByCustomer::where('userCustomer_id', '=', $userCustomerId)->where('used', '=', '0')->first();
        if (is_null($promo)) {
            return 0.0;
        } else {
            $promo->used = "1";
            $promoCode = PromoCode::where('id', '=', $promo->promoCode_id)->first();
            $promo->save();
            if ($promoCode->expireDate < date("Y-m-d")) {
                return 0.0;
            }
            return doubleval($promoCode->percent);
        }
    }

    function setHistory(Request $request)
    {
        $userCustomer_id = $request->get('userCustomer_id');
        $origin = $request->get('origin');
        $destination = $request->get('destination');
        $date = date("Y-m-d");
        $hour = date('H');
        $userRider_id = $request->get('userRider_id');
        $historyId = $this->generateRandomString(6);
        $distanceTraveled = doubleval($request->get('distance'));
        $duration = doubleval($request->get('duration'));
        $destLat = $request->get('destLat');
        $originLng = $request->get('originLng');
        $destLng = $request->get('destLng');
        $originLat = $request->get('originLat');
        $startTime = $request->get('rideStartTime');
        $endTime = $request->get('rideEndTime');


        $farePerMinuteCol = Constant::where('variable', '=', 'farepermin')->first();


        $farePerKmcol = Constant::where('variable', '=', 'fareperkm')->first();

        $baseFareCol = Constant::where('variable', '=', 'basefare')->first();

        $companyPercentCol = Constant::where('variable', '=', 'companypercent')->first();


        $promoPercent = $this->getPromoPercent($userCustomer_id);
        $farePerMinute = doubleval($farePerMinuteCol->value);
        $fareperkm = doubleval($farePerKmcol->value);
        $baseFare = doubleval($baseFareCol->value);
        $companyPercentage = doubleval($companyPercentCol->value);


        $fakeFare = $baseFare + $fareperkm * $distanceTraveled + $duration * $farePerMinute;
        $companyFakeFare = $fakeFare * ($companyPercentage / 100.0);

        $discountAmount = $fakeFare * ($promoPercent / 100.0);
        $actualFare = $fakeFare - $discountAmount;

        $companyFare = $companyFakeFare - $discountAmount;

        $riderPercent = $fakeFare - $companyFakeFare;


        $history = new History();
        $history->userCustomer_id = $userCustomer_id;
        $history->origin = $origin;
        $history->destination = $destination;
        $history->date = $date;
        $history->hour = $hour;
        $history->fare = $actualFare;
        $history->riderPercent = $riderPercent;
        $history->companyPercent = $companyFare;
        $history->userRider_id = $userRider_id;
        $history->historyId = $historyId;
        $history->travelDuration = $duration;
        $history->travelDistance = $distanceTraveled;
        $history->destLat = $destLat;
        $history->originLng = $originLng;
        $history->destLng = $destLng;
        $history->originLat = $originLat;
        $history->rideStartTime = $startTime;
        $history->rideEndTime = $endTime;
        $history->promoAmount = $discountAmount;


        $history->save();

        $userCustomer = UserCustomer::where('id', '=', $userCustomer_id)->first();
        $userCustomer->history_historyId = $historyId;
        $userCustomer->save();

        $userRider = UserRider::where('id', '=', $userRider_id)->first();
        $moneyDue = doubleval($userRider->moneyDue);
        $moneyDue += $companyFare;
        $userRider->moneyDue = $moneyDue;
        $userRider->save();

        return response()->json([
            'response' => 'success',
            'detail' => $history
        ]);

    }
}
