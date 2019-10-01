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

// Route::prefix('admin')->group(function() {
//     Route::get('/home', 'AdminController@index');
// });admin.auth:admin
Route::group(['middleware' => ['auth:admin'],'prefix' => 'admin'], function () {
    Route::get('/', 'AdminController@index')->name('admin.home');
    Route::resource('psb', 'PsbController');
    Route::resource('akademik', 'AkademikController');
    Route::resource('mahasiswa', 'MahasiswaController');
    Route::resource('dosen', 'DosenController');
    Route::post('api/dosen','DosenController@dosenlist')->name('api.dosen');
    Route::post('api/mhs','MahasiswaController@mhs')->name('api.mhs');
    Route::get('/modal/mhs/nilai','MahasiswaController@nilai')->name('modal.nilai');
    Route::get('/modal/mhs/ktm/{id}','MahasiswaController@ktm')->name('modal.ktm');
    Route::get('/xx','AdminController@home');
    Route::post('/psb/store', 'PsbController@create')->name('psbgelombang.store');
    Route::get('list/psb','PsbController@data_psb')->name('data.psb');
    Route::post('psb/delete','PsbController@hapus')->name('delete.psb');
    Route::post('psb/posting/','PsbController@storepsb')->name('posting.psb');
    Route::get('keuangan/kra', 'KeuanganController@kra')->name('kra.index');
    Route::post('keuangan/kra/api','KeuanganController@kralist')->name('kra.list');
 

});
