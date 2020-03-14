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
    Route::resource('/users', 'UserController')->except([
        'create', 'store', 'update', 'destroy'
    ]);

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
    Route::get('/giving-types', 'GivingTypeController@index');

    //Patrons
    Route::resource('patrons', 'PatronController');
});

Route::prefix('rest/secured')->group(function () {
    //Users
    Route::get('/users', 'UserController@loadUsers');
    Route::post('/users', 'UserController@store');
    Route::delete('/users/{id}', 'UserController@destroy');
    Route::put('/users', 'UserController@update');

    //Members
    Route::get('/members', 'MemberController@loadMembers');
    Route::post('/members', 'MemberController@store');
    Route::delete('/members/{id}', 'MemberController@destroy');
    Route::put('/members', 'MemberController@update');

    //Parish Routes
    Route::get('/parishes/{parishId}', 'ParishController@loadParish');
    Route::get('/parishes', 'ParishController@loadParishes');
    Route::post('/parishes', 'ParishController@store');
    Route::put('/parishes', 'ParishController@update');

    Route::get('/zones', 'ZoneController@loadZones');
    Route::get('/zones/parishes/{parishId}', 'ZoneController@loadZonesByParishId');
    Route::post('/zones', 'ZoneController@store');
    Route::put('/zones', 'ZoneController@update');

    Route::get('/communities', 'CommunityController@loadCommunities');
    Route::get('/communities/zones/{zoneId}', 'CommunityController@loadCommunitiesByZoneId');
    Route::post('/communities', 'CommunityController@store');
    Route::put('/communities', 'CommunityController@update');

    //Giving-Types Routes
    Route::get('/giving-types', 'GivingTypeController@findGivingtypes');
    Route::post('/giving-types', 'GivingTypeController@store');
    Route::put('/giving-types', 'GivingTypeController@update');

    //Giving Routes
     Route::get('/givings', 'GivingController@findGivings');
     Route::post('/givings', 'GivingController@store');
     Route::put('/givings', 'GivingController@update');

     //Patron Routes
    Route::get('/patrons', 'PatronController@findPatrons');
    Route::post('/patrons', 'PatronController@store');
    Route::put('/patrons', 'PatronController@update');
});

