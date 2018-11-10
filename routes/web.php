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

Route::get('/', 'PageController@index')->name('home');

Route::get('login', 'UserController@getLogin')->name('login');
Route::post('login', 'UserController@postLogin');

Route::group(['prefix'=>'real-estate'], function(){
    Route::get('/', ['as' => 'realEstateList', 'uses' => 'RealEstateController@list']);
    Route::get('/data', 'RealEstateController@data');
    Route::get('/edit', 'RealEstateController@edit');
    Route::post('/edit', 'RealEstateController@update');
    Route::get('/create', 'RealEstateController@create');
    Route::post('create', 'RealEstateController@store');
    Route::get('/delete', 'RealEstateController@delete');
    Route::post('/multi-delete', 'RealEstateController@multiDelete');

});