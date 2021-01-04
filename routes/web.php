<?php

use Illuminate\Support\Facades\Route;
Route::get('/', function () {
    return redirect('login');
});
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::post('postLogin', '\App\Http\Controllers\Auth\LoginController@postLogin')->name("postLogin");
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
->name('home');
;

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home')->middleware('auth');
Route::get('/profile', 'App\Http\Controllers\ProfileController@profile')->name('profile')->middleware('auth');
Route::put('/postProfile', 'App\Http\Controllers\ProfileController@postProfile')->name('postProfile')->middleware('auth');
Route::get('/changePassword', 'App\Http\Controllers\ProfileController@changePassword')->name('changePassword')->middleware('auth');
Route::put('/postPassword', 'App\Http\Controllers\ProfileController@password')->name('postPassword')->middleware('auth');



