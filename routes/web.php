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
Route::get('add-betslip', 'MainController@getAddBetSlip');
Route::post('add-betslip', 'MainController@postAddBetSlip');

Route::get('transactions', 'MainController@getPurchases');
Route::get('transactions', 'MainController@getPurchases');

Route::get('view-bs', 'MainController@getBetSlip');
Route::get('v-g', 'MainController@getGame');

Route::get('support', 'MainController@getSupport');
Route::get('pricing', 'MainController@getPricing');


/**
 Admin routes
**/
Route::get('nimda', 'AdminController@getDashboard');
Route::get('nimda/enable/{id?}', 'AdminController@getEnable');
Route::get('nimda/disable/{id?}', 'AdminController@getDisable');

Route::get('nimda/shez/{status?}/{id?}', 'AdminController@getMarkTicket');
Route::get('nimda/swqq/{status?}/{id?}', 'AdminController@getMarkGame');
Route::get('nimda/users', 'AdminController@getUsers');
Route::get('nimda/ut/{action?}/{id?}', 'AdminController@getManageTokens');
Route::post('nimda/ut', 'AdminController@postManageTokens');

Route::get('nimda/transactions', 'AdminController@getPurchases');
Route::get('nimda/betslips', 'AdminController@getTickets');
Route::get('nimda/betslip/{id?}', 'AdminController@getBetSlip');

Route::get('nimda/other-leagues', 'AdminController@getOtherLeagues');
Route::get('nimda/add-country', 'AdminController@getAddCountry');
Route::get('nimda/add-competition', 'AdminController@getAddCompetition');
Route::get('nimda/add-team', 'AdminController@getAddTeam');

Route::get('nimda/get-competitions', 'AdminController@getCompetitions');
Route::get('nimda/get-teams', 'AdminController@getTeams');