<?php

// cache()->remember('accounts', 24 * 60, function () {
//     return App\Models\Trips\Account::all();
// });

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/event', function () {
        event(new App\Events\Trips\OrderCreatedEvent(App\Models\Trips\Order::first()));
    });

    Route::get('/dummy', function () {
        sleep(5);
        return response("worked", 200);
    });

    Route::redirect('/home', '/trips');
    Route::redirect('/', '/trips');
    Route::resource('trucks', 'TrucksController');
    Route::resource('trucks/{truck}/revenue-report', 'Trucks\RevenueReportController');
    Route::resource('trips', 'TripsController');
    Route::resource('trips/{trip}/orders', 'Trips\TripOrdersController');
    Route::resource('trips/{trip}/ledgers', 'Trips\TripLedgersController');

    Route::resource('trips/orders/pods', 'Trips\Orders\PODsController');
    Route::resource('trips/orders/balance-payments', 'Trips\Orders\BalancePaymentsController');
    Route::resource('trips/orders/credits', 'Trips\Orders\CreditsController');

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
