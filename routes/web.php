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

Route::get('/', 'LinksController@index')->name('links.index');
Route::post('/', 'LinksController@create')->name('links.create');
Route::get('/~{key}', 'LinksController@meta')->name('links.meta');
Route::get('/{key}', 'LinksController@redirect')->name('links.redirect');
