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
Route::get('earnings', 'WebpanelController@getEarnings');
Route::get('unsuccessfulrides', 'WebpanelController@getUnsuccessfulRides');
Route::get('constants', 'WebpanelController@getConstants');
