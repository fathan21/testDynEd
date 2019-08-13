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

Route::group(['prefix' => 'v1','namespace' => 'Api'], function($app)
{
  $app->any('/setting','SettingController@get');
  $app->any('/category_home','SettingController@categoryHome');
  $app->any('/galery_home','SettingController@galeryHome');

  $app->any('/sidebar','SettingController@sidebar');
  $app->any('/headline','SettingController@headline');
  $app->any('/news','SettingController@news');
  $app->any('/news_detail/{link}','SettingController@news_detail');
  $app->any('/news_detail_related/{link}','SettingController@news_detail_related');
});
//Route::group(['prefix' => 'v1/admin', 'middleware' => ['auth:api', 'owner']], function(){
Route::group(['prefix' => 'v1/admin','namespace' => 'Api\admin', 'middleware' => ['cors']], function($app){
  $app->any('/login','AuthController@login');
  $app->any('/forgot_password','AuthController@forgot_password');
  $app->any('/test','AuthController@test');
});

Route::group(['prefix' => 'v1/admin','namespace' => 'Api\admin', 'middleware' => ['cors','apiToken']], function($app){
  $app->get('/nav','AuthController@getNav');
  $app->resource('/users','UserController');
  $app->resource('/galery','GaleryController');
  $app->post('/galery/upload','GaleryController@upload');
  $app->resource('/video','VideoController');
  $app->resource('/content','ContentController');
  $app->resource('/categories','MenuController');
  $app->resource('/headline','HeadlineController');
  $app->post('/content_upload','ContentController@upload');
  $app->get('/content_category','ContentController@getCategoryMenu');
  $app->get('/categories_parent','MenuController@getCategoryParent');

});
