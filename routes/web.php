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
Route::get('tips', 'MainController@getGames');
Route::get('results', 'MainController@getResults');

Route::get('my-tips', 'MainController@getBetSlips');
Route::get('add-tip', 'MainController@getAddBetSlip');
Route::post('add-tip', 'MainController@postAddBetSlip');

Route::get('transactions', 'MainController@getPurchases');
Route::get('transactions', 'MainController@getPurchases');

Route::post('view-bs', 'MainController@postBetSlip');
Route::post('v-g', 'MainController@postGame');

Route::get('support', 'MainController@getSupport');
Route::get('pricing', 'MainController@getPricing');

Route::get('gc', 'MainController@getCompetitions');
Route::get('gt', 'MainController@getTeams');

Route::get('profile', 'MainController@getSettings');
Route::post('profile', 'MainController@postSettings');

Route::get('subscribe/{em}', 'MainController@getSubscribe');
Route::get('unsubscribe/{em}', 'MainController@getUnsubscribe');

Route::post('notiff', 'MainController@getNotification');


/**
 Admin routes
**/
Route::get('nimda', 'AdminController@getDashboard');
Route::get('nimda/enable/{id}', 'AdminController@getEnable');
Route::get('nimda/disable/{id}', 'AdminController@getDisable');

Route::get('nimda/shez/{status}/{id}', 'AdminController@getMarkTicket');
Route::get('nimda/swqq/{status}/{id}/{bsID}', 'AdminController@getMarkGame');
Route::get('nimda/users', 'AdminController@getUsers');
Route::get('nimda/ut/{action}/{id}', 'AdminController@getManageTokens');
Route::post('nimda/ut', 'AdminController@postManageTokens');

Route::get('nimda/transactions', 'AdminController@getPurchases');
Route::get('nimda/tips', 'AdminController@getTickets');
Route::get('nimda/tip/{id}', 'AdminController@getBetSlip');

Route::get('nimda/other-leagues', 'AdminController@getOtherLeagues');
Route::get('nimda/add-country', 'AdminController@getAddCountry');
Route::get('nimda/add-competition', 'AdminController@getAddCompetition');
Route::get('nimda/add-team', 'AdminController@getAddTeam');

Route::get('nimda/get-competitions', 'AdminController@getCompetitions');
Route::get('nimda/get-teams', 'AdminController@getTeams');

Route::get('nimda/a-s', 'AdminController@getAddScoreLine');

Route::get('nimda/leads', 'AdminController@getLeads');
Route::get('nimda/add-leads', 'AdminController@getAddLeads');
Route::post('nimda/add-leads', 'AdminController@postAddLeads');