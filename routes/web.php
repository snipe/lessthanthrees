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


Route::pattern('subdomain', '^((?!www).)*$');

Route::group([
    'domain' => '{subdomain}.'.config('app.domain'),
    'middleware' => \App\Http\Middleware\Subdomain::class], function () {

    Route::get('/home', array('as' => 'user.home', 'uses' => 'ItemsController@showUserHome'));
    Route::post('/fave/{id}', array('as' => 'item.fave', 'uses' => 'ItemsController@faveItem'));
    Route::post('/unfave/{id}', array('as' => 'item.unfave', 'uses' => 'ItemsController@unfaveItem'));
    Route::get('/vueitems/{category?}', array('as' => 'user.items.list', 'uses' => 'ItemsController@showUserItems'));
    Route::get('/login', function () {
        return redirect()->route('home');
    });
    Route::get('/{category}', array('as' => 'user.items', 'uses' => 'ItemsController@showItemsPage'));
    Route::get('/', array('as' => 'user.home', 'uses' => 'ItemsController@showUserHome'));

});



Route::post('/fave/{id}', array('as' => 'item.fave', 'uses' => 'ItemsController@faveItem'));
Route::post('/unfave/{id}', array('as' => 'item.unfave', 'uses' => 'ItemsController@unfaveItem'));
Route::get('/saved', array('as' => 'user.faved', 'uses' => 'ItemsController@showUserFavesPage'));
Route::post('/unfave/{id}', array('as' => 'item.unfave', 'uses' => 'ItemsController@unfaveItem'));
Route::get('/vueitems/saved', 'ItemsController@showUserFaves');
Route::get('/vueitems/{category}', array('as' => 'user.items.list', 'uses' => 'ItemsController@showUserItems'));
Route::post('/vueitems/{id}', 'ItemsController@deleteItem' );
Route::get('/vueitems', 'ItemsController@readItems');
Route::post('/vueitems', 'ItemsController@storeItem' );


Route::get('auth/{provider}', [ 'as' => 'oauth', 'uses' => 'Auth\LoginController@redirectToProvider' ]);
Route::get('auth/{provider}/callback', [ 'as' => 'oauth.callback', 'uses' => 'Auth\LoginController@handleProviderCallback' ]);



Route::group([ 'prefix' => 'account','middleware' => ['auth']], function () {

    Route::get('/', array('as' => 'account.home', 'uses' => 'AccountController@index'));
    Route::get('/subscription', array('as' => 'account.subscription', 'uses' => 'AccountController@getSubscription'));
    Route::post('/subscription', array('as' => 'account.subscription.process', 'uses' => 'AccountController@processSubscription'));
    Route::post('/subscription/cancel', array('as' => 'account.subscription.cancel', 'uses' => 'AccountController@processCancellation'));
    Route::post('/subscription/reactivate', array('as' => 'account.subscription.reactivate', 'uses' => 'AccountController@processReactivation'));

});

Route::post(
    'stripe/webhook',
    '\Laravel\Cashier\Http\Controllers\WebhookController@handleWebhook'
);

/*
 * General routes
 */
Route::get('/tos', function () {
    return view('welcome');
});

Route::get('/privacy', function () {
    return view('welcome');
});




Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [ 'as' => 'home', 'uses' => 'HomeController@index' ]);
