<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');

//geth
Route::get('/geth/unlock', function () {
    return view('unlock');
});
Route::post('/geth/unlock', 'GethController@unlock');
Route::post('/geth', 'GethController@postDeploy');

//print
Route::post('/print', 'PrintController@index');

//View info
Route::get('/info', function (){
    return view("info");
});
Route::post('/info', 'InfoController@index');
