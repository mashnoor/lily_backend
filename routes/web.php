<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('dashboard', 'WebpanelController@getDashboard');

Route::get('customerrides', 'WebpanelController@getMostActiveUsers');
Route::get('/customerrides/search', 'WebpanelController@search_at_Customer_rides');
route::get('profile/{name}','WebpanelController@UserCustomerProfile');

Route::get('riders', 'WebpanelController@UserRiders');
Route::get('/riders/search', 'WebpanelController@search_at_User_Riders');
route::get('riders/profile/{name}','WebpanelController@userRidersProfile');

Route::get('earnings', 'WebpanelController@getEarnings');
Route::get('unsuccessfulrides', 'WebpanelController@getUnsuccessfulRides');
Route::get('constants', 'WebpanelController@getConstants');


Route::post('update/{id}', 'WebpanelController@Update_UserRiders_status');
Route::get('banned', 'WebpanelController@Banned_Riders');