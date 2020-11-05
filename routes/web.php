<?php
Auth::routes();
Route::get('/', function () {
    return redirect('/home');
});
Route::get('/item/index/', 'ItemController@index')->name('item.index');
Route::get('/item/detail/{id}', 'ItemController@detail')->name('item.detail');

Route::group(['middleware' => 'auth:user'], function() {
	Route::get('/home', 'HomeController@index')->name('home');
	Route::get('/logout', 'HomeController@banUser');
//	Route::get('/item/index/', 'ItemController@index')->name('item.index');
//	Route::get('/item/detail/{id}', 'ItemController@detail')->name('item.detail');
	Route::get('/cart/index', 'CartController@index')->name('cart.index');
//	Route::post('/cart/index', 'CartController@index')->name('cart.index');
	Route::post('/cart/index', 'CartController@add')->name('cart.add');
	Route::delete('/cart/index', 'CartController@delete')->name('cart.delete');
	Route::get('/address/index', 'AddressController@index')->name('address.index');
	Route::get('/address/add', 'AddressController@add')->name('address.add');
	Route::post('/address/add', 'AddressController@create')->name('address.create');
	Route::get('/address/edit', 'AddressController@edit')->name('address.edit');
	Route::post('/address/edit', 'AddressController@update')->name('address.update');
	Route::delete('/address/index', 'AddressController@delete')->name('address.delete');
});
Route::group(['prefix' => 'admin'], function() {
	Route::get('login', 'Admin\LoginController@showLoginForm')->name('admin.login');
	Route::post('login', 'Admin\LoginController@login');
});
Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function() {
	Route::get('home', 'HomeController@index')->name('admin.home');
	Route::post('logout', 'Admin\LoginController@logout')->name('admin.logout');
	Route::get('logout', 'HomeController@banAdmin');
	Route::get('/item/index/', 'ItemController@index')->name('admin.item.index');
	Route::get('/item/detail/{id}', 'ItemController@detail')->name('admin.item.detail');
	Route::get('/item/edit', 'ItemController@edit')->name('admin.item.edit');
	Route::post('/item/edit', 'ItemController@update')->name('admin.item.update');
	Route::get('/item/add', 'ItemController@add')->name('admin.item.add');
	Route::post('/item/add', 'ItemController@create')->name('admin.item.create');
});
