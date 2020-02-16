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

use Illuminate\Support\Facades\Redis;

Route::get('/', 'SignUpController@index');
Route::post('/', 'SignUpController@store')->name('store');

Route::get('/send', 'SignUpController@sendMessage');

Route::get('/publish', function(){
    Redis::publish('channel', json_encode(['cash' => 'clear']));
});
