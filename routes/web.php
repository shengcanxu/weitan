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
    Route::get('/calculateCO2', 'EnergyUsageController@docalculateCO2');
    Route::get('/calculateCO2/{date}', 'EnergyUsageController@docalculateCO2AtDate');
    Route::get('/CO2output', 'EnergyUsageController@CO2output');
});

//化石燃料盘库数据
Route::group(['middleware'=>'auth', 'prefix'=>'EnergyStorage'], function(){
    Route::get('/energyusage', 'EnergyStorageController@enerageusage');
    Route::get('/cusage', 'EnergyStorageController@cusage');
});

//过程排放入库数据
Route::group(['middleware'=>'auth','prefix'=>'Procedure'], function (){
    Route::get('/', 'ProcedureStoreController@index');
    Route::post('/', 'ProcedureStoreController@store');
    Route::get('/{id}/delete', 'ProcedureStoreController@delete');
    Route::post('/{id}/change', 'ProcedureStoreController@change');
    Route::post('/{id}/tagerror', 'ProcedureStoreController@tagerror');
    Route::post('/{id}/analysis', 'ProcedureStoreController@storeanalysis');
    Route::get('/{id}/analysis', 'ProcedureStoreController@getanalysis');
    Route::post('/{id}/analysis/{aid}/tagerror', 'ProcedureStoreController@analysistagerror');
});

//过程排放使用数据
Route::group(['middleware'=>'auth', 'prefix'=>'ProcedureUsage'], function(){
    Route::get('/','ProcedureUsageController@index');
    Route::post('/','ProcedureUsageController@store');
    Route::post('/{id}/change', 'ProcedureUsageController@change');
    Route::get('/{id}/delete', 'ProcedureUsageController@delete');
    Route::post('/{id}/tagerror', 'ProcedureUsageController@tagerror');
    Route::get('/{id}/analysis', 'ProcedureUsageController@getanalysis');
    Route::post('/{id}/analysis', 'ProcedureUsageController@storeanalysis');
    Route::post('/{id}/analysis/{aid}/tagerror', 'ProcedureUsageController@analysistagerror');
    Route::get('/calculateCO2', 'ProcedureUsageController@docalculateCO2');
    Route::get('/calculateCO2/{date}', 'ProcedureUsageController@docalculateCO2AtDate');
    Route::get('/CO2output', 'ProcedureUsageController@CO2output');
});

//热力使用内部记录
Route::group(['middleware'=>'auth', 'prefix'=>'Heatinner'], function(){
    Route::get('/','HeatInnerUsageController@index');
    Route::post('/','HeatInnerUsageController@store');
    Route::post('/{id}/change', 'HeatInnerUsageController@change');
    Route::get('/{id}/delete', 'HeatInnerUsageController@delete');
    Route::post('/{id}/tagerror', 'HeatInnerUsageController@tagerror');
});

//热力使用外部证明
Route::group(['middleware'=>'auth', 'prefix'=>'Heatouter'], function(){
    Route::get('/','HeatOuterUsageController@index');
    Route::post('/','HeatOuterUsageController@store');
    Route::post('/{id}/change', 'HeatOuterUsageController@change');
    Route::get('/{id}/delete', 'HeatOuterUsageController@delete');
    Route::post('/{id}/tagerror', 'HeatOuterUsageController@tagerror');
});

//电力使用内部记录
Route::group(['middleware'=>'auth', 'prefix'=>'Electricinner'], function(){
    Route::get('/','ElectricInnerUsageController@index');
    Route::post('/','ElectricInnerUsageController@store');
    Route::post('/{id}/change', 'ElectricInnerUsageController@change');
    Route::get('/{id}/delete', 'ElectricInnerUsageController@delete');
    Route::post('/{id}/tagerror', 'ElectricInnerUsageController@tagerror');
});

//电力使用外部记录
Route::group(['middleware'=>'auth', 'prefix'=>'Electricouter'], function(){
    Route::get('/','ElectricOuterUsageController@index');
    Route::post('/','ElectricOuterUsageController@store');
    Route::post('/{id}/change', 'ElectricOuterUsageController@change');
    Route::get('/{id}/delete', 'ElectricOuterUsageController@delete');
    Route::post('/{id}/tagerror', 'ElectricOuterUsageController@tagerror');
});

//废水厌氧
Route::group(['middleware'=>'auth', 'prefix'=>'Dirtywater'], function(){
    Route::get('/','DirtyWaterController@index');
    Route::post('/','DirtyWaterController@store');
    Route::post('/{id}/change', 'DirtyWaterController@change');
    Route::get('/{id}/delete', 'DirtyWaterController@delete');
    Route::post('/{id}/tagerror', 'DirtyWaterController@tagerror');
});


Route::group(['prefix' => 'helper'], function()
{
    Route::get('/token', 'HelperController@token');
    Route::get('/energytypes', 'HelperController@energytypes');
    Route::get('/materialtypes', 'HelperController@materialtypes');
    Route::post('/uploadimage', 'HelperController@uploadimage');
    Route::get('/energyusagedefaults','HelperController@energyusagedefaults');
    Route::get('/energyusagedefault/{type}', 'HelperController@energyusagedefault');
    Route::get('/heatproducetypes', 'HelperController@heatProduceTypes');
    Route::get('/heatdatasource', 'HelperController@heatdatasource');
    Route::get('/electricproducetypes', 'HelperController@electricproducetypes');
});

Route::get('/energystoretest', 'TestController@energystoretest');
Route::get('/energyusagetest', 'TestController@energyusagetest');
Route::get('/procedurestoretest','TestController@procedurestoretest');
Route::get('/procedureusagetest', 'TestController@procedureusagetest');
Route::get('/heattest', 'TestController@heattest');
Route::get('/electrictest', 'TestController@electrictest');
Route::get('/dirtywater', 'TestController@dirtywater');
Route::get('/test','TestController@index2');


