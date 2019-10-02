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
    Route::resource('kurikulum', 'KurikulumController');
    //krs
    Route::resource('krs', 'KrsController');
    Route::post('api/krs','KrsController@krslist')->name('api.krs');
    Route::post('api/krs/config','KrsController@krsconfig')->name('krs.config');
    Route::get('createkrsconfig','KrsController@createkrsconfig')->name('config.krs');
    Route::post('krs/config','KrsController@storeconfig')->name('store.config');
    Route::get('edit/krs/config/{id}','KrsController@editconfig')->name('config.edit');
    Route::post('update/krs/config/{id}','KrsController@updateconfig')->name('config.update');

    Route::resource('kelas', 'KelasController');
    Route::post('api/kelas','KelasController@kelaslist')->name('api.kelas');

    //krs

    Route::resource('matakuliah', 'MatakuliahController');
    Route::post('api/mk','MatakuliahController@mklist')->name('api.mk');

    Route::post('api/dosen','DosenController@dosenlist')->name('api.dosen');
    Route::post('api/mhs','MahasiswaController@mhs')->name('api.mhs');
    Route::post('api/kurikulum','KurikulumController@list')->name('api.kurikulum');
    Route::get('/modal/mhs/nilai','MahasiswaController@nilai')->name('modal.nilai');
    Route::get('/modal/mhs/ktm/{id}','MahasiswaController@ktm')->name('modal.ktm');
    Route::get('/modal/pndah/mhs/{id}','MahasiswaController@pindah')->name('modal.pindah');
    Route::post('postpindah/{id}','MahasiswaController@postpindah')->name('post.pindah');
    Route::get('/xx','AdminController@home');
    Route::post('/psb/store', 'PsbController@create')->name('psbgelombang.store');
    Route::get('list/psb','PsbController@data_psb')->name('data.psb');
    Route::post('psb/delete','PsbController@hapus')->name('delete.psb');
    Route::post('psb/posting/','PsbController@storepsb')->name('posting.psb');
    Route::get('keuangan/kra', 'KeuanganController@kra')->name('kra.index');
    Route::post('keuangan/kra/api','KeuanganController@kralist')->name('kra.list');


});
