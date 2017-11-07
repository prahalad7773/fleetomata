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

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::redirect('/home', '/trucks');
    Route::redirect('/', '/trucks');
    Route::resource('trucks', 'TrucksController');
    Route::resource('trucks/{truck}/revenue-report', 'Trucks\RevenueReportController');
    Route::resource('trips', 'TripsController');
    Route::resource('trips/{trip}/orders', 'Trips\TripOrdersController');
    Route::resource('trips/{trip}/ledgers', 'Trips\TripLedgersController');
    Route::get('approvals', 'Trips\TripLedgersController@approvals');
    Route::get('/api/customers', function () {
        return App\Models\Trips\Customer::where('phone', request()->get('phone'))->first() ?? null;
    });
    Horizon::auth(function () {
        return true;
    });
});
