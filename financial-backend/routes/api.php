<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/* Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
}); */


Route::get('login', 'ApiController@login');
Route::get('register', 'ApiController@register');
Route::get('currencies', 'CurrenciesController@index');
Route::get('currencies/create', 'CurrenciesController@store');
Route::get('currencies/{id}', 'CurrenciesController@show');

Route::group(['middleware' => 'auth.jwt'], function () {
    Route::get('logout', 'ApiController@logout');
    Route::get('user', 'ApiController@getCurrentUser');

    Route::get('user/update', 'ApiController@update');
    Route::get('transactions', 'TransactionsController@index');
    Route::get('transactions/create', 'TransactionsController@store');
    Route::get('transactions/{id}', 'TransactionsController@show');
    Route::put('transactions/{id}', 'TransactionsController@update');

    Route::post('currencies', 'CurrenciesController@store');
    Route::put('currencies/{id}', 'CurrenciesController@update');


    Route::get('categories', 'CategoriesController@index');
    Route::get('categories/create', 'CategoriesController@store');
    Route::get('categories/{id}', 'CategoriesController@show');
    Route::get('categories/update/{id}', 'CategoriesController@update');
});
