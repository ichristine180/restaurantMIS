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
 // waiter -----tables creation
 Route::get('/tables','App\Http\Controllers\WaiterController@tables')->name('tables')->middleware('waiter');
 Route::post('/createTables','App\Http\Controllers\WaiterController@create')
 ->name('createTables')->middleware('waiter');
 Route::delete('/destroyTables/{id}','App\Http\Controllers\WaiterController@destroy')
 ->name('destroyTables')->middleware('waiter');
 Route::get('/order','App\Http\Controllers\WaiterController@orders')->name('orders')->middleware('waiter');
 Route::get('students/list', [WaiterController::class, 'getStudents'])->name('waiterHome.list');

 //Route::get('students', [StudentController::class, 'index']);

//Route::get('students/list', [StudentController::class, 'getStudents'])->name('students.list');
Route::get('/orders','App\Http\Controllers\WaiterController@orders')->name('orders')->middleware('auth');
Route::get('/orders/list','App\Http\Controllers\WaiterController@ordersList')->name('orders.list')->middleware('auth');
Route::get('/orders/nonPayed','App\Http\Controllers\WaiterController@nonPayed')->name('orders.nonPayed')->middleware('waiter');
Route::get('/orders/paidList','App\Http\Controllers\WaiterController@paidList')->name('orders.paidList')->middleware('waiter');
Route::get('/orders/paid','App\Http\Controllers\WaiterController@paid')->name('orders.paid')->middleware('waiter');
Route::get('/orders/archived','App\Http\Controllers\WaiterController@archived')->name('orders.archived')->middleware('waiter');
Route::get('/orders/archivedList','App\Http\Controllers\WaiterController@archivedList')->name('orders.archivedList')->middleware('waiter');
Route::get('/orders/create','App\Http\Controllers\WaiterController@createOrders')->name('orders.create')->middleware('waiter');
Route::post('/orders/postOrders','App\Http\Controllers\WaiterController@postOrders')->name('orders.postOrders')->middleware('waiter');

// cashier routes
Route::get('/orders/cashier/nonPayed','App\Http\Controllers\CashierController@nonPayed')->name('orders.cashier.nonPayed')->middleware('auth');
Route::get('/orders/cashier/paidList','App\Http\Controllers\CashierController@paidList')->name('orders.cashier.paidList')->middleware('auth');
Route::get('/orders/cashier/paid','App\Http\Controllers\CashierController@paid')->name('orders.cashier.paid')->middleware('auth');
Route::get('/orders/cashier/archived','App\Http\Controllers\CashierController@archived')->name('orders.cashier.archived')->middleware('auth');
Route::get('/orders/cashier/archivedList','App\Http\Controllers\CashierController@archivedList')->name('orders.cashier.archivedList')->middleware('auth');
Route::get('/bill/{orderId}','App\Http\Controllers\BillController@create')->name('bill')->middleware('cashier');
Route::get('/pay/{billId}','App\Http\Controllers\BillController@pay')->name('pay')->middleware('cashier');
Route::get('/bills','App\Http\Controllers\BillController@bills')->name('bills')->middleware('cashier');
Route::get('/bills/paid','App\Http\Controllers\BillController@paidBills')->name('bills.payed')->middleware('cashier');
Route::get('/bills/nonPaid','App\Http\Controllers\BillController@nonPaid')->name('bills.nonPayed')->middleware('cashier');
Route::get('/bills/nonPayedList','App\Http\Controllers\BillController@notpaidBills')->name('bills.nonPayedList')->middleware('cashier');
Route::get('/bills/archived','App\Http\Controllers\BillController@archived')->name('bills.archived')->middleware('cashier');
Route::get('/bills/billsList','App\Http\Controllers\BillController@billsList')->name('bills.billsList')->middleware('cashier');
Route::get('/bills/archivedList','App\Http\Controllers\BillController@archivedList')->name('bills.archivedList')->middleware('cashier');
Route::get('/bills/all','App\Http\Controllers\BillController@all')->name('bills.all')->middleware('cashier');
Route::get('/bills/printAll','App\Http\Controllers\BillController@printAll')->name('printAll')->middleware('cashier');

Route::get('/orders/supervisor/nonPayed','App\Http\Controllers\SuperVisorController@nonPayed')->name('orders.supervisor.nonPayed')->middleware('auth');