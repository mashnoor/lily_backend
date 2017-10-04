<?php

namespace App\Http\Controllers;

use App\PromoCode;
use App\PromoUsedByCustomer;
use App\UserCustomer;
use Illuminate\Http\Request;

class PromoController extends Controller
{
    function applyPromo(Request $request)
    {
        $code = $request->get('promocode');
        $token = $request->get('token');

        //Find the user
        $user = UserCustomer::where('token', $token)->first();
        if(is_null($user))
        {
            return response()->json([
               'response' => 'token invalid'
            ]);
        }

        //Check if promo is valid
        $promo = PromoCode::where('code', $code)->first();
        if (is_null($promo))
        {
            return response()->json([
                'response' => 'promo invalid'
            ]);
        }
        //Check the expiriy
        $todayDate = date("Y-m-d");
        $expiry = $promo->expireDate;
        if($todayDate > $expiry)
        {
            return response()->json([
                'response' => 'promo expired'
            ]);
        }

        //Check if already used
        $promoUsed = PromoUsedByCustomer::where('userCustomer_id', $user->id)->where('promoCode_id', $promo->id)->first();
        if(!is_null($promoUsed))
        {
            return response()->json([
                'response' => 'promo already applied'
            ]);
        }
        $newPromoUser = new PromoUsedByCustomer();
        $newPromoUser->promoCode_id = $promo->id;
        $newPromoUser->userCustomer_id = $user->id;
        $newPromoUser->save();
        return response()->json([
            'response' => 'promo applied successfully',
            'percentage' => $promo->percent,
        ]);
    }
}
