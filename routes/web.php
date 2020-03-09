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

    //Dashboard
    Route::get('/', 'DashboardController@index');

    //Member
    Route::resource('/members', 'MemberController')->except([
        'create', 'store', 'update', 'destroy'
    ]);

    //Parish Routes
    Route::resource('/parishes', 'ParishController')->only([
        'index', 'show'
    ]);

    //Zones Routes
    Route::resource('/zones', 'ZoneController')->only([
        'index', 'show'
    ]);

    //Community Routes
    Route::resource('/communities', 'CommunityController')->only([
        'index', 'show'
    ]);

    //Giving Routes
    Route::get('/givings', 'GivingController@index');

    //Patrons
    Route::resource('patrons', 'PatronController');
});

Route::prefix('rest/secured')->group(function () {
    //Members
    Route::get('/members', 'MemberController@loadMembers');
    Route::post('/members', 'MemberController@store');

    //Parish Routes
    Route::get('/parishes/{parishId}', 'ParishController@loadParish');
    Route::get('/parishes', 'ParishController@loadParishes');
    Route::post('/parishes', 'ParishController@store');
    Route::put('/parishes', 'ParishController@update');

    Route::get('/zones', 'ZoneController@loadZones');
    Route::post('/zones', 'ZoneController@store');
    Route::put('/zones', 'ZoneController@update');

    Route::get('/communities', 'CommunityController@loadCommunities');
    Route::post('/communities', 'CommunityController@store');
    Route::put('/communities', 'CommunityController@update');

    //Giving Routes
    Route::get('/givings', 'GivingController@findGivings');
    Route::post('/givings', 'GivingController@store');
    Route::put('/givings', 'GivingController@update');

     //Patron Routes
    Route::get('/patrons', 'PatronController@findPatrons');
    Route::post('/patrons', 'PatronController@store');
    Route::put('/patrons', 'PatronController@update');
});

