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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace' => 'Api', 'prefix' => 'v1'], function () {

	Route::group(['namespace' => 'V1'], function(){

		Route::group(['namespace' => 'User'], function(){

	    	Route::get('/user', 'UserController@show'); //获取用户
	    	Route::post('/user', 'UserController@store'); //注册用户
	    	Route::put('/user', 'UserController@update'); //编辑用户
	    	Route::delete('/user', 'UserController@destroy'); //删除用户

		});

		Route::post('login', 'AuthController@login')->name('login');//登录

		Route::group(['middleware' => 'auth:api'], function () {

		    Route::delete('logout', 'AuthController@logout'); //退出
		    Route::get('refresh', 'AuthController@refresh'); //刷新 token
		    Route::get('me', 'AuthController@me'); //获取用户

		});

	});

});

