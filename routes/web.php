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

Route::group(['prefix' => 'auth'], function () {
    Auth::routes(['register' => false]);
});
Route::get('/', 'DashboardController@index');
Route::prefix('dashboard')->group(function () {
    Route::get('/', 'DashboardController@index');
    Route::resource('/members', 'MemberController');
    Route::resource('/parishes', 'ParishController');
    Route::get('/parishes/{parishId}/zones/{zoneId}', 'ParishController@viewCommunities');
});

Route::prefix('rest/secured')->group(function () {
    Route::get('/', 'DashboardController@index');
    Route::resource('/members', 'MemberController');
    Route::post('/parishes', 'ParishController@store');
    Route::get('/parishes', 'ParishController@loadParishes');
    Route::get('/parishes/{parishId}', 'ParishController@loadParish');
    Route::get('/parishes/{parishId}/zones', 'ParishController@loadZonesByParishId');
    Route::post('/parishes/{parishId}/zones', 'ParishController@createZone');
    Route::get('/parishes/{parishId}/zones/{zoneId}/communities', 'ParishController@loadCommunitiesByZoneId');
    Route::post('/parishes/{parishId}/zones/{zoneId}/communities', 'ParishController@createCommunity');
});

