<?php

// cache()->remember('accounts', 24 * 60, function () {
//     return App\Models\Trips\Account::all();
// });

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/event', function () {
        event(new App\Events\Trips\OrderCreatedEvent(App\Models\Trips\Order::first()));
    });
    Route::redirect('/home', '/trucks');
    Route::redirect('/', '/trucks');
    Route::resource('trucks', 'TrucksController');
    Route::resource('trucks/{truck}/revenue-report', 'Trucks\RevenueReportController');
    Route::resource('trips', 'TripsController');
    Route::resource('trips/{trip}/orders', 'Trips\TripOrdersController');
    Route::resource('trips/{trip}/ledgers', 'Trips\TripLedgersController');
    Route::get('reports/p-l-report', 'Reports\PLReportController@index');
    Route::get('approvals', 'Trips\TripLedgersController@approvals');

    Route::get('/route-report', 'Reports\RouteReportController@index');
    Route::resource('/requirements', 'Trips\RequirementsController');
    Route::resource('/users', 'UsersController');

    Route::get('/api/customers', function () {
        return App\Models\Trips\Customer::where('phone', request()->get('phone'))->first() ?? null;
    });
    Horizon::auth(function () {
        return true;
    });
});
