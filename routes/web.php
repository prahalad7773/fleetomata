<?php

use App\Models\Trip;
use App\Trips\Customer;

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
    Route::redirect('/home', '/');
    Route::get('/', 'HomeController@index');

    Route::resource('trucks', 'TrucksController');
    Route::resource('trips', 'TripsController');
    Route::resource('trips/{trip}/orders', 'Trips\TripOrdersController');
    Route::get('/create', function () {
        return view("trips/orders/partials/_create")->with([
            'trip' => Trip::first(),
        ]);
    });
    Route::get('/api/customers', function () {
        return Customer::where('phone', request()->get('phone'))->first() ?? null;
    });

});
