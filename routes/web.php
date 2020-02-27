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

//Rutas de la parte pública

Route::get('/', 'HomeController@index');

Route::get('/category/{name}', 'HomeController@indexCategory');

Route::get('/about', function () {
    return view('about');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/post/{id}', 'HomeController@getPost');

Route::get('/author/{id}', 'HomeController@getAuthor');

//Rutas del dashboard

Auth::routes();

//Rutas de publicaciones

Route::resource('/dashboard/post', 'PostController')->middleware('auth');

//Rutas de usuarios

Route::resource('/dashboard/user', 'UserController')->middleware('auth');
Route::get('/dashboard/user/{user}/addrole/{role}', 'UserController@addRole')->middleware('auth');
Route::get('/dashboard/user/{user}/removerole/{role}', 'UserController@removeRole')->middleware('auth');

//Rutas de autores

Route::get('/dashboard/author/create/{user}', 'AuthorController@create')->middleware('auth');
Route::post('/dashboard/author/store/{user}', 'AuthorController@store')->middleware('auth');
Route::put('/dashboard/author/{author}/update', 'AuthorController@update')->middleware('auth');
Route::delete('/dashboard/author/{author}/delete', 'AuthorController@destroy')->middleware('auth');

//Rutas de categorías

Route::resource('/dashboard/category', 'CategoryController')->middleware('auth');

