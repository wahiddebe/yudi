<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'HomeController@welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/rute', 'RouteController@index')->name('route');
Route::get('/Kategori', 'KategoriController@index')->name('kategori');
Route::get('/Kategori/create', 'KategoriController@create')->name('kategori.create');
Route::post('/Kategori/add', 'KategoriController@add')->name('kategori.add');
Route::get('/Kategori/edit/{id}', 'KategoriController@edit')->name('kategori.edit');
Route::get('/Kategori/update/{id}', 'KategoriController@update')->name('kategori.update');


Route::get('/maps', 'MapsController@index')->name('maps');
Route::get('/maps/create', 'MapsController@create')->name('maps.create');