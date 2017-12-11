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
    Route::get('trips/pending-payments', 'TripsController@pendingPayments');
    Route::resource('trips', 'TripsController');
    Route::resource('trips/{trip}/orders', 'Trips\TripOrdersController');
    Route::resource('trips/{trip}/ledgers', 'Trips\TripLedgersController');
    Route::resource('reports/p-l-report', 'Reports\PLReportController');

    Route::get('reports/route-report', 'Reports\RouteReportController@index');
    Route::get('/requirements/remittance', 'Trips\RequirementsController@remittance');
    Route::resource('/requirements', 'Trips\RequirementsController');
    Route::resource('/users', 'UsersController');

    Route::get('/api/customers', function () {
        return App\Models\Trips\Customer::where('phone', request()->get('phone'))->first() ?? null;
    });
    Horizon::auth(function () {
        return true;
    });
});
