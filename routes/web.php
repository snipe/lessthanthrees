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


/*
 * User routes
 */
Route::group(['domain' => '{subdomain}.'.env('APP_DOMAIN')], function()
{
    Route::any('/', function($subdomain)
    {
        Route::get('/home', 'HomeController@index');
        Route::get ( '/vueitems', 'HomeController@readItems' );
        Route::post ( '/vueitems', 'HomeController@storeItem' );
        Route::post ( '/vueitems/{id}', 'HomeController@deleteItem' );
    });
});



/*
 * General routes
 */
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
