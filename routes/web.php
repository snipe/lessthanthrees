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
    Route::get('/vueitems/{category}', array('as' => 'user.items.list', 'uses' => 'ItemsController@showUserItems'));
    Route::get('/{category}', array('as' => 'user.items', 'uses' => 'ItemsController@showItemsPage'));
    Route::get('/', array('as' => 'user.home', 'uses' => 'ItemsController@showUserHome'));

});


Route::get('/saved', array('as' => 'user.faved', 'uses' => 'ItemsController@showUserFavesPage'));
Route::post('/unfave/{id}', array('as' => 'item.unfave', 'uses' => 'ItemsController@unfaveItem'));
Route::get('/vueitems/saved', 'ItemsController@showUserFaves');
Route::get('/vueitems/{category}', array('as' => 'user.items.list', 'uses' => 'ItemsController@showUserItems'));
Route::post('/vueitems/{id}', 'ItemsController@deleteItem' );
Route::get('/vueitems', 'ItemsController@readItems');
Route::post('/vueitems', 'ItemsController@storeItem' );


Route::get('auth/{provider}', [ 'as' => 'oauth', 'uses' => 'Auth\LoginController@redirectToProvider' ]);
Route::get('auth/{provider}/callback', [ 'as' => 'oauth.callback', 'uses' => 'Auth\LoginController@handleProviderCallback' ]);


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
