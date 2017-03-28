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

Route::get('/home', 'HomeController@index');

Route::group(['middleware'=>'auth','prefix'=>'EnergyStore'], function (){
    Route::get('/', 'EnergyStoreController@index');
    Route::post('/', 'EnergyStoreController@store');
    Route::get('/{id}/delete', 'EnergyStoreController@delete');
    Route::post('/{id}/change', 'EnergyStoreController@change');
    Route::post('/{id}/tagerror', 'EnergyStoreController@tagerror');
    Route::post('/{id}/analysis', 'EnergyStoreController@analysis');
    Route::get('/{id}/analysis', 'EnergyStoreController@getanalysis');
    Route::post('/{id}/analysis/{aid}/tagerror', 'EnergyStoreController@analysistagerror');
});

Route::group(['prefix' => 'helper'], function()
{
    Route::get('/token', 'HelperController@token');
    Route::get('/energytypes', 'HelperController@energytypes');
    Route::post('/uploadimage', 'HelperController@uploadimage');
});

Route::get('/test2', 'TestController@index2');


