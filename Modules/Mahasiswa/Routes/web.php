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

// Route::prefix('mahasiswa')->group(function() {
//     Route::get('/', 'MahasiswaController@index');
// });
Route::group(['middleware' => ['auth'],'prefix' => 'home'], function () {
     Route::get('dashboard', 'MahasiswaController@index')->name('mahasiswa.home');
     Route::resource('kartu-studi','KrsController');
     Route::post('api/krs/mhs','KrsController@list')->name('krs.mhs');

});
