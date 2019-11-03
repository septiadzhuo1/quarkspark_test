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



Auth::routes();
Route::group(['middleware' => ['auth', 'web']], function () {
	Route::resource('admin/users', 'UserController');
	Route::resource('book', 'BookController');
	Route::get('admin/users/resetpassword/{id}', );

	Route::get('changepassword/{id}', 'UserController@ResetPassword')->name('passwordreset.reset');
	Route::get('', 'HomeController@index')->name('home');
	Route::get('/home', 'HomeController@index')->name('home');
	Route::get('/changeStatus', 'UserController@changeStatus');
	Route::get('/approval/', 'BookController@Approval');
});


Route::get('/home', function() {
    return view('home');
})->name('home')->middleware('auth');

Route::get('/email', 'EmailController@sendmail');