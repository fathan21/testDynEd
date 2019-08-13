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

Route::get('/img/{w}/{h}', function () {
	echo "dasdsa";
});

Route::get('img/{filename}/{w?}/{h?}', function( $filename, $w=100, $h=100){

    $cacheimage = Image::cache(function($image) use($filename, $w, $h){
    	$filepath = 'assets/img/galery/'.$filename;
        return $image->make($filepath)->fit($w,$h);

    },24); // cache for 10 minutes

    return Response::make($cacheimage, 200, array('Content-Type' => 'image/jpeg'));
});
Route::get('resize-image/{filename}/{w?}/{h?}', function( $filename, $w=100, $h=100){

    $cacheimage = Image::cache(function($image) use($filename, $w, $h){
    	$filepath = 'assets/img/galery/'.$filename;
        return $image->make($filepath)->fit($w,$h);

    },24); // cache for 10 minutes

    return Response::make($cacheimage, 200, array('Content-Type' => 'image/jpeg'));
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

