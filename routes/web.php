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
Route::get('/lien-he', ['as' => 'contact', 'uses' => 'PageController@getContact']);

Route::get('/login', ['as' => 'login', 'uses' => 'AuthenticateController@getLogin']);
Route::post('/login', ['as' => 'post.login', 'uses' => 'AuthenticateController@postLogin']);
Route::get('/logout', ['as' => 'logout', 'uses' => 'AuthenticateController@getLogout']);
Route::get('/register', ['as' => 'register', 'uses' => 'AuthenticateController@getRegister']);
Route::post('/register', ['as' => 'post.register', 'uses' => 'AuthenticateController@postRegister']);

Route::group(['middleware'=>'auth'], function(){
    Route::get('/doi-mat-khau', ['as' => 'change_password', 'uses' => 'AuthenticateController@getChangepassword']);
    Route::post('/doi-mat-khau', ['as' => 'post.change_password', 'uses' => 'AuthenticateController@postChangepassword']);
    Route::get('/thong-tin-thanh-vien', ['as' => 'info', 'uses' => 'AuthenticateController@getInfo']);
    Route::post('/thong-tin-thanh-vien', ['as' => 'post.info', 'uses' => 'AuthenticateController@postInfo']);

    Route::group(['prefix'=>'bat-dong-san'], function(){
        Route::get('/{filter?}', ['as' => 'realEstateList', 'uses' => 'RealEstateController@list'])->where('filter', 'tin-rao-het-han|tin-rao-cho-duyet|tin-rao-nhap|tin-rao-da-xoa');
        Route::get('/data',['as' => 'realEstateData', 'uses' => 'RealEstateController@data']);
        Route::get('/edit', 'RealEstateController@edit');
        Route::post('/edit', 'RealEstateController@update');
        Route::get('/tao-moi', 'RealEstateController@create');
        Route::post('create', 'RealEstateController@store');
        Route::get('/delete', 'RealEstateController@delete');
        Route::post('/multi-delete', 'RealEstateController@multiDelete');

    });
});
