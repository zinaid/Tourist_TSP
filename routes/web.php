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

// RUTE ZA JEZIKE
Route::get('locale/{locale}', function ($locale){
    Session::put('locale', $locale);
    return redirect()->back();
});

Route::get('/languages', function () {
    return view('languages');
});

// RUTE ZA INDEX I POVRATAK NA INDEX
Route::get('/', function () {
    return view('index');
});

Route::get('/back', function () {
    return view('index'); 
});

// RUTE ZA MAPU SA GENETSKIM ALGORITMOM
Route::get('/route', function () {
    return view('map_router');
});

// RUTE ZA DODAVANJE LOKACIJA I CISCENJE BAZE
Route::post('/add_location', 'LocationController@store')->name('location');
Route::post('/empty_map', 'LocationController@destroy')->name('location');

// RUTA ZA AJAX KOJI ISPISUJE LOKACIJE IZ MAPE
Route::get('/returnplace', 'LocationController@show')->name('location');

// RUTE ZA POSTAVKE
Route::get('/settings', 'SettingsController@index')->name('settings');
Route::post('/podesavanje', 'SettingsController@store')->name('location');


	