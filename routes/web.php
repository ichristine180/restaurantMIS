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
//dashboard routes
Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home')->middleware('managingDirector');
Route::get('/waiterHome', 'App\Http\Controllers\HomeController@waiterHome')->name('waiterHome')->middleware('waiter');
Route::get('/managerHome', 'App\Http\Controllers\HomeController@managerHome')->name('managerHome')->middleware('manager');
Route::get('/supervisorHome', 'App\Http\Controllers\HomeController@supervisorHome')->name('supervisorHome')->middleware('supervisor');
Route::get('/cashierHome', 'App\Http\Controllers\HomeController@cashierHome')->name('cashierHome')->middleware('cashier');
Route::get('/profile', 'App\Http\Controllers\ProfileController@profile')->name('profile')->middleware('auth');
Route::put('/postProfile', 'App\Http\Controllers\ProfileController@postProfile')->name('postProfile')->middleware('auth');
Route::get('/changePassword', 'App\Http\Controllers\ProfileController@changePassword')->name('changePassword')->middleware('auth');
Route::put('/postPassword', 'App\Http\Controllers\ProfileController@password')->name('postPassword')->middleware('auth');

// managing drector routes
Route::get('/employees','App\Http\Controllers\UserController@index')->name('employees')->middleware('auth');
Route::get('register','App\Http\Controllers\Auth\RegisterController@showRegistrationForm')->name('register')->middleware('auth');
Route::post('postregister','App\Http\Controllers\Auth\RegisterController@registerEmployee')->name('postregister')->middleware('auth');
Route::get('/update/{id}','App\Http\Controllers\Auth\RegisterController@showEdit')->name('update')->middleware('auth');
Route::post('/putUpdate','App\Http\Controllers\Auth\RegisterController@putUpdate')->name('putUpdate')->middleware('auth');

