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

/*Route::get('/', function () {
    return view('welcome');
});*/

// --  present Welcome view by checking DB connection
Route::get('/', 'UserController@checkDbConnection');
// -- click of `Backup Database` button
Route::get('download', 'UserController@download');

