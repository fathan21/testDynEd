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

Route::group(['prefix' => 'v1'], function($app)
{
  $app->any('/setting','Api\SettingController@get');
  $app->any('/category_home','Api\SettingController@categoryHome');
  $app->any('/galery_home','Api\SettingController@galeryHome');

  $app->any('/populer','Api\SettingController@populer');
});
