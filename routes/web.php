<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes(['verify' => true]);

Route::get('/pwdreset/{token}', 'HomeController@passwordreset')->name('resetpwd');
Route::get('/order/dispute/{transaction_id}', 'JoloApiController@orderdispute')->name('orderdispute');
Route::get('/order/disputecheck', 'JoloApiController@orderdisputecheck')->name('orderdisputecheck');
Route::get('/bus_search', 'HomeController@bus_search')->name('bus_search');

Route::get('/admin', 'HomeController@adminlogin')->name('adminlogin');
//Route::get('/admin/dashboard', 'AdminController@index')->name('admindashboard');
Route::get('/admin/index', 'AdminController@index')->name('admin');
Route::get('/admin/users', 'AdminController@users')->name('users_list');
Route::get('/admin/forgetpwd', 'HomeController@forgetpwd')->name('forgetpwd');
Route::get('/admin/transaction', 'AdminController@transaction')->name('transaction_list');



Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profile', 'UsersController@index')->name('profile');
// Route::get('/profile', 'UsersController@index')->name('addmoney');
Route::post('/profile/updatepassword', 'UsersController@updatepassword')->name('updatepassword');
Route::post('/profile', 'UsersController@update')->name('updateprofile');
Route::get('/phoneVerify', 'UsersController@verifyPhone')->name('phoneverify');
Route::get('/optphone', 'UsersController@optphone');
Route::get('/order-history', 'UsersController@orderHistory')->name('transaction');
Route::post('/codeCheck', 'UsersController@codeCheck');
Route::get('/auth/redirect/{provider}', 'SocialController@redirect');
Route::get('/callback/{provider}', 'SocialController@callback');
Route::get('/JoloApi/index', 'JoloApiController@index');
Route::post('/JoloApi/getDthOperator', 'JoloApiController@getDthOperator')->name('getDthOperator');
Route::post('/JoloApi/getDthPlan', 'JoloApiController@getDthPlan')->name('getDthPlan');
Route::post('/JoloApi/getOperator', 'JoloApiController@getOperator')->name('getOperator');
Route::post('/JoloApi/getPlan', 'JoloApiController@getPlan')->name('getPlan');
Route::get('/JoloApi/getApiBalance', 'JoloApiController@apiBalance')->name('getApiBalance');

Route::post('/JoloApi/apiRecharge', 'JoloApiController@apiRecharge')->name('joloapiRecharge');
Route::post('/JoloApi/apiDthRecharge', 'JoloApiController@apiDthRecharge')->name('joloapiDthRecharge');

Route::post('/checkout/mobile', 'JoloApiController@checkoutMobile')->name('checkoutMobile');
Route::post('/checkout/dth', 'JoloApiController@checkoutDTH')->name('checkoutDTH');
Route::post('/checkout/CCA', 'JoloApiController@checkoutCCA')->name('checkoutCCA');

Route::post('/indipay/response', 'JoloApiController@ccresponse');
Route::post('/indipay/ccAddMoney', 'JoloApiController@ccAvenueAddMoney')->name('ccAddMoney');

Route::get('/testingMyself', 'JoloApiController@testingMyself');

Route::any('/bus/index', 'BusController@index')->name('busSearch');
//Route::get('autocomplete', 'BusController@autocomplete')->name('autocomplete');
Route::get('autocomplete', 'HomeController@autocomplete')->name('autocomplete');

Route::post('/ajax/storeMobileDt', 'JoloApiController@storeMobileDt')->name('storeMobileDt');
Route::post('/ajax/storeDthDt', 'JoloApiController@storeDthDt')->name('storeDthDt');
Route::get('/ajax/storeMobileDt', 'JoloApiController@checkMobileDt')->name('storeMobileDt');


