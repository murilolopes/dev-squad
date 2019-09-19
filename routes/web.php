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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/categories', function() {
	return \App\Category::get()->all('name', 'id');
})->name('categories.index');

Route::get('/validate_product_name/{name}', function($name) {
	if (\App\Product::whereName($name)->first()) return Response::json(['ja tem'], 422);
	
	return Response::json(['tem nao pode cadastrar'], 200);
})->name('products.datatable');

Route::get('/products/datatable', 'ProductsController@datatable')->name('products.datatable');
Route::get('/products/import', 'ProductsController@importView')->name('products.importView');
Route::post('/products/import', 'ProductsController@import')->name('products.import');

Route::resource('products', 'ProductsController');


