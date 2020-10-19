<?php
Auth::routes();
Route::get('/', function () {
    return redirect('/home');
});

Route::group(['middleware' => 'auth:user'], function() {
	Route::get('/home', 'HomeController@index')->name('home');
	Route::get('/logout', 'HomeController@banUser');
});
Route::group(['prefix' => 'admin'], function() {
	Route::get('login', 'Admin\LoginController@showLoginForm')->name('admin.login');
	Route::post('login', 'Admin\LoginController@login');
});
Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function() {
	Route::get('home', 'HomeController@index')->name('admin.home');
	Route::post('logout', 'Admin\LoginController@logout')->name('admin.logout');
	Route::get('logout', 'HomeController@banAdmin');
});
//Route::get('/home', 'HomeController@index')->name('home');
Route::get('/item/index/', 'ItemController@index')->name('item.index');
Route::get('/item/detail/{id}', 'ItemController@detail')->name('item.detail');
