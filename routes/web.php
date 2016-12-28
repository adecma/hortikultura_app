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

//custome route for auth
Route::get('/', 'Auth\LoginController@showLoginForm');
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/', function () {
    return view('static.welcome');
})->name('welcome');

Route::get('/about', function () {
    return view('static.about');
})->name('about');

Route::get('/kontak', function () {
    return view('static.kontak');
})->name('kontak');

Route::group(['middleware' => 'auth'], function() {
	//beranda
	Route::get('/home', 'HomeController@index');
	
	//profile
	Route::get('/profile', 'HomeController@showProfile')
        ->name('profile.show');
    Route::get('/profile/edit', 'HomeController@editProfile')
        ->name('profile.edit');
    Route::post('/profile/edit', 'HomeController@updateProfile')
        ->name('profile.update');
    
    //master
    Route::get('/hortikultura/topdf/{time}', 'HortikulturaController@toPDF')
        ->name('hortikultura.topdf');
    Route::resource('/hortikultura', 'HortikulturaController', ['except' => ['show']]);
    Route::get('/variable/topdf/{time}', 'VariableController@toPDF')
        ->name('variable.topdf');
    Route::resource('/variable', 'VariableController', ['except' => ['show']]);
    Route::get('/derajat/topdf/{time}', 'DerajatController@toPDF')
        ->name('derajat.topdf');
    Route::resource('/derajat', 'DerajatController', ['except' => ['show']]);

    //analisa
    Route::get('/analisa_variable/topdf/{time}', 'AnalisaController@toPDF')
        ->name('analisa.topdf');
    Route::get('/analisa_variable', 'AnalisaController@variable')
        ->name('analisa.variable');
});
