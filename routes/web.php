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


Route::get('/', 'HomeController@index')->name('home');


Auth::routes();

Route::get('loan', 'LoanController@index')->name('loan');
Route::get('create-loan', 'LoanController@create')->name('loan.create');
Route::post('store-loan', 'LoanController@store')->name('loan.store');
Route::get('detail-loan/{id}', 'LoanController@show')->name('loan.show');
Route::get('edit-loan/{id}', 'LoanController@edit')->name('loan.edit');
Route::put('update-loan/{id}', 'LoanController@update')->name('loan.update');
Route::delete('delete-loan/{id}', 'LoanController@destroy')->name('loan.destroy');


