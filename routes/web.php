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

//化石燃料入库数据
Route::group(['middleware'=>'auth','prefix'=>'EnergyStore'], function (){
    Route::get('/', 'EnergyStoreController@index');
    Route::post('/', 'EnergyStoreController@store');
    Route::get('/{id}/delete', 'EnergyStoreController@delete');
    Route::post('/{id}/change', 'EnergyStoreController@change');
    Route::post('/{id}/tagerror', 'EnergyStoreController@tagerror');
    Route::post('/{id}/analysis', 'EnergyStoreController@storeanalysis');
    Route::get('/{id}/analysis', 'EnergyStoreController@getanalysis');
    Route::post('/{id}/analysis/{aid}/tagerror', 'EnergyStoreController@analysistagerror');
});

//化石燃料入炉数据
Route::group(['middleware'=>'auth', 'prefix'=>'EnergyUsage'], function(){
    Route::get('/','EnergyUsageController@index');
    Route::post('/','EnergyUsageController@store');
    Route::post('/{id}/change', 'EnergyUsageController@change');
    Route::get('/{id}/delete', 'EnergyUsageController@delete');
    Route::post('/{id}/tagerror', 'EnergyUsageController@tagerror');
    Route::get('/{id}/analysis', 'EnergyUsageController@getanalysis');
    Route::post('/{id}/analysis', 'EnergyUsageController@storeanalysis');
    Route::post('/{id}/analysis/{aid}/tagerror', 'EnergyUsageController@analysistagerror');
});


Route::group(['prefix' => 'helper'], function()
{
    Route::get('/token', 'HelperController@token');
    Route::get('/energytypes', 'HelperController@energytypes');
    Route::post('/uploadimage', 'HelperController@uploadimage');
});

Route::get('/energystoretest', 'TestController@energystoretest');
Route::get('/energyusagetest', 'TestController@energyusagetest');


