<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace'=>'Api','prefix'=>'','as'=>'api.','middleware'=>['api.before']],function(){
    // Route::resource('test', 'TestApiController',['names'=>['index'=>'test.index'],]);
    //资源路由 RESTful
    Route::group(['namespace'=>'AppletApis','prefix'=>''],function (){
        Route::group(['prefix' => '', 'as'=>'check.'], function () {
            Route::get('test','TestApiController@index')->name('index');
            Route::post('test','TestApiController@store')->name('store');
            Route::get('test/create','TestApiController@create')->name('create');
            Route::get('test/{id}','TestApiController@show')->name('test.show');
            Route::get('test/{id}/edit','TestApiController@edit')->name('edit');
            Route::put('test/{id}','TestApiController@update')->name('update');
            Route::delete('test/{id}','TestApiController@destroy')->name('destroy');
        });

        Route::group(['prefix' => '', 'as'=>'login.'],function (){
            Route::get('login','LoginController@index')->name('index');
            Route::post('login','LoginController@store')->name('store');
            Route::get('login/create','LoginController@create')->name('create');
            Route::get('login/{id}','LoginController@show')->name('show');
            Route::get('login/{id}/edit','LoginController@edit')->name('edit');
            Route::put('login/{id}','LoginController@update')->name('update');
            Route::delete('login/{id}','LoginController@destroy')->name('destroy');
        });
    });
});
