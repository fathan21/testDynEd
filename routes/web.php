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

Route::any('/', function () {
    return view('vue');
});
Route::any('/{any}', function () {
    return view('vue');
});
Route::any('/{any}/{any1}', function () {
    return view('vue');
});
Route::get('/web', function () {
    return view('vue');
});
Route::get('/vue', function () {
    return view('vue');
});
