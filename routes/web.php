<?php
///// Public Routes
Route::get('/', 'HomeController@home')->name('home');
Auth::routes();

Route::get('/blog/article', 'ArticleController@index')->name('article.index');
Route::get('/blog/article/{slug}', 'ArticleController@show')->name('article.show');
Route::get('/blog/category', 'CategoryController@index')->name('category.index');
Route::get('/blog/category/{slug}', 'CategoryController@show')->name('category.show');

///// Admin routes
///// Article
Route::prefix('admin')->group( function() {
	// Admin dashboard
	Route::get('/', 'HomeController@admin')->name('admin');
	///// User
	Route::prefix('/user')->name('user.')->group( function() {
		Route::get('/', 'UserController@admin')->name('admin');
		Route::get('/edit/{article}', 'UserController@edit')->name('edit');
		
		Route::patch('/{article}', 'UserController@update')->name('update');
		Route::delete('/{article}', 'UserController@destroy')->name('destroy');
	});
	//// Article
	Route::prefix('/blog/article')->name('article.')->group( function() {
		Route::get('/', 'ArticleController@admin')->name('admin');
		Route::get('/create', 'ArticleController@create')->name('create');
		Route::get('/edit/{article}', 'ArticleController@edit')->name('edit');
		Route::get('/details/{article}', 'ArticleController@details')->name('details');

		Route::post('/', 'ArticleController@store')->name('store');
		Route::patch('/{article}', 'ArticleController@update')->name('update');
		Route::delete('/{article}', 'ArticleController@destroy')->name('destroy');
	});
	///// Category
	Route::prefix('/blog/category')->name('category.')->group( function() {
		Route::get('/', 'CategoryController@admin')->name('admin');
		Route::get('/create', 'CategoryController@create')->name('create');
		Route::get('/edit/{category}', 'CategoryController@edit')->name('edit');
		Route::get('/details/{category}', 'CategoryController@details')->name('details');

		Route::post('/', 'CategoryController@store')->name('store');
		Route::patch('/{category}', 'CategoryController@update')->name('update');
		Route::delete('/{category}', 'CategoryController@destroy')->name('destroy');
	});
});