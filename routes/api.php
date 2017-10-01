<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::post('/signupusercustomer', 'UsercustomerController@signup');
Route::post('/signupuserrider', 'UserriderController@signup');
Route::post('/setcurrentlocation', 'CurrentlocationController@setcurrentlocation');
Route::post('/getfreeriders', 'CurrentlocationController@getFreeRiders');
Route::post('/setcomplain', 'ComplainController@setComplain');
Route::post('/getcustomerprofile', 'UsercustomerController@getCustomerProfile');
Route::post('/getriderprofile', 'UserriderController@getRiderProfile');
Route::post('/gethistory', 'HistoryController@getHistory');
Route::post('/setunsuccessfulride', 'UnsuccessfulRideController@setUnsuccessfulRide');
Route::post('/getriderprofilebyphone', 'UserriderController@getRiderProfileByPhone');
Route::post('/sendnotification', 'NotificationController@sendNotfication');
Route::post('/setrating', 'RatingController@setRating');