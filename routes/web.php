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
    return view('home');
});
Route::post('/departure/create','DepartureController@create')->name('departurecreate');
Route::delete('/departure/delete/{id}','DepartureController@delete')->name('departuredelete');
Route::put('/departure/update','DepartureController@update')->name('departureupdate');

Route::post('/position/create','PositionController@create')->name('positioncreate');
Route::delete('/position/delete/{id}','PositionController@delete')->name('positiondelete');
Route::put('/position/update','PositionController@update')->name('positionupdate');

Route::post('/employee/create','EmployeeController@create')->name('employeecreate');
Route::delete('/employee/delete/{id}','EmployeeController@delete')->name('employeedelete');
Route::put('/employee/update','EmployeeController@update')->name('employeeupdate');


Route::get('/allQuery','QueryController@allQuery')->name('allQuery');