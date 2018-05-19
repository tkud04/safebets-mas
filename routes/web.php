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

Route::get('/', 'MainController@getIndex');
Route::post('become-a-seller', 'MainController@postSellerJoin');
// Route::get('file/sslsslsafetre', 'MainController@getFile');
Route::get('football', 'MainController@getFootball');
Route::get('gf', 'MainController@getFixtures');

Route::post('register', 'LoginController@postRegister');
Route::post('login', 'LoginController@postLogin');
Route::get('logout', 'LoginController@getLogout');
Route::get('lost-password', 'LoginController@getPassword');
Route::post('lost-password', 'LoginController@postPassword');
Route::get('change-password/{rxf?}', 'LoginController@getChangePassword');
Route::post('change-password', 'LoginController@postChangePassword');

Route::get('dashboard', 'MainController@getDashboard');
Route::get('games', 'MainController@getGames');
Route::get('betslips', 'MainController@getBetSlips');
Route::get('view-bs', 'MainController@getBetSlip');
Route::get('support', 'MainController@getSupport');
Route::get('pricing', 'MainController@getPricing');


/**
 Admin routes
**/
Route::get('nimda', 'AdminController@getDashboard');
Route::get('nimda/users', 'AdminController@getUsers');
Route::get('nimda/user/{id?}/{action?}', 'AdminController@getManageTokens');
Route::post('nimda/user', 'AdminController@postManageTokens');

Route::get('nimda/betslips', 'AdminController@getBetSlips');
Route::get('nimda/betslip/{id?}', 'AdminController@getBetSlip');
Route::get('nimda/mark-betslip/{id?}/{result?}', 'AdminController@getMarkBetSlip');
Route::get('nimda/mark-game/{id?}/{result?}', 'AdminController@getMarkGame');