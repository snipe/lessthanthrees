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





Route::get ( '/vueitems', 'HomeController@readItems' );
Route::post ( '/vueitems', 'HomeController@storeItem' );
Route::post ( '/vueitems/{id}', 'HomeController@deleteItem' );

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

Route::get('/', function () {
    return view('welcome');
});



Auth::routes();

Route::get('/home', [ 'as' => 'home', 'uses' => 'HomeController@index' ]);
