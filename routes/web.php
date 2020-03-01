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
    Route::resource('/users', 'UserController');
    Route::resource('/parishes', 'ParishController');
});

Route::prefix('rest/secured')->group(function () {
    Route::get('/', 'DashboardController@index');
    Route::resource('/users', 'UserController');
    Route::resource('/parishes', 'ParishController');
});

