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
    //return view('welcome');
    return view('top');
});

Route::group(['middleware' => ['auth', 'isVerified']], function () {
	Route::get('stock/add','StockController@create');
	Route::post('stock/add','StockController@store');
	Route::get('/stocks','StockController@index')->name('stocks');
    Route::get('/graphs','StockController@index')->name('graphs');
	Route::post('/graphs','StockController@changeprj');
	Route::get('stock/chart/{sensorid}','StockController@chart');
	Route::get('stock/chart2/{sensorid}/{fromdate}/{todate}','StockController@chart2');
	Route::get('stock/housa/{sensorid1}/{sensorid2}','StockController@housa');
	Route::get('/settings','SettingController@index')->name('settings');
	Route::get('sensdata/chart','SensdataController@chart');
	Route::get('sensdata/onesenserdata/{snsid}','SensdataController@onesenserdata')->name('sensdata');
	Route::get('/statistics', 'StatisticsController@index')->name('statistics');
	Route::get('/home', 'HomeController@index')->name('home');
	Route::resource('tweets', 'TweetController');
	Route::resource('projectatusers', 'ProjectatusersController');
	Route::resource('sensdata', 'SensdataController');
	Route::resource('sensor', 'SensorController');
	Route::resource('sensunit', 'SensunitController');
	Route::resource('setting', 'SettingController');
	Route::resource('shieldmodule', 'ShieldmoduleController');
	Route::resource('statistics', 'StatisticsController');
});

Auth::routes();

