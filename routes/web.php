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
//employee management
Route::get('/employees','App\Http\Controllers\UserController@index')->name('employees')->middleware('auth');
Route::get('register','App\Http\Controllers\Auth\RegisterController@showRegistrationForm')->name('register')->middleware('auth');
Route::post('postregister','App\Http\Controllers\Auth\RegisterController@registerEmployee')->name('postregister')->middleware('auth');
Route::get('/update/{id}','App\Http\Controllers\Auth\RegisterController@showEdit')->name('update')->middleware('auth');
Route::post('/putUpdate','App\Http\Controllers\Auth\RegisterController@putUpdate')->name('putUpdate')->middleware('auth');
Route::delete('/destroyUser/{id}','App\Http\Controllers\UserController@destroy')->name('destroyUser')->middleware('auth');
Route::get('/addRole/{id}','App\Http\Controllers\Auth\RegisterController@addRole')->name('addRole')->middleware('auth');
Route::post('/PostAddRole','App\Http\Controllers\Auth\RegisterController@PostAddRole')->name('PostAddRole')->middleware('auth');
// product managements ---- category mgmt
 Route::get('/category','App\Http\Controllers\Admin\CategoryController@index')->name('category')->middleware('auth');
 Route::get('/createcategory','App\Http\Controllers\Admin\CategoryController@create')->name('createcategory')->middleware('auth');
 Route::post('/categorystore','App\Http\Controllers\Admin\CategoryController@store')->name('categorystore')->middleware('auth');
 Route::delete('/destroy/{id}','App\Http\Controllers\Admin\CategoryController@destroy')->name('destroy')->middleware('auth');
 Route::put('/editcategory/{id}','App\Http\Controllers\Admin\CategoryController@update')->name('editcategory')->middleware('auth');
 Route::get('/showform/{id}','App\Http\Controllers\Admin\CategoryController@edit')->name('showform')->middleware('auth');
 Route::get('/viewItem/{id}','App\Http\Controllers\Admin\CategoryController@viewItem')->name('viewItem')->middleware('auth');

// product managements ---- items mgmt
 Route::get('/items','App\Http\Controllers\Admin\ItemController@index')->name('items')->middleware('auth');
 Route::post('/create','App\Http\Controllers\Admin\ItemController@store')->name('create')->middleware('auth');
 Route::get('/showIform/{id}','App\Http\Controllers\Admin\ItemController@create')->name('showIform')->middleware('auth');
 Route::delete('/delete/{id}','App\Http\Controllers\Admin\ItemController@destroy')->name('delete')->middleware('auth');
 Route::put('/editItem/{id}','App\Http\Controllers\Admin\ItemController@update')->name('editItem')->middleware('auth');
 Route::get('/ShowIUform/{id}','App\Http\Controllers\Admin\ItemController@edit')->name('ShowIUform')->middleware('auth');