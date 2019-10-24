<?php

use Illuminate\Http\Request;

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
    Route::post('api/krs/ijin','KrsController@krs_ijin')->name('krs.ijin');
    Route::get('krs/ijin/create','KrsController@create_ijin_krs')->name('create.ijin-krs');
    Route::post('simpan/ijinkrs','KrsController@simpan_ijin')->name('simpan_ijinkrs');
    Route::post('hapusijin/krs','KrsController@delete_ijin')->name('delete.ijinkrs');
    Route::get('mahasiswa/cari/{name}', function (Request $request) {
        $dt=DB::table('mahasiswa')
            ->join('users','users.uuid','mahasiswa.users_uuid')
            ->select('mahasiswa.users_uuid','users.name')->where('users.name', 'LIKE','%'. $request->get('term').'%')->limit(10)->get();

            return response()->json($dt);
    })->name('select.mhs');

    Route::get('createkrsconfig','KrsController@createkrsconfig')->name('config.krs');
    Route::post('krs/config','KrsController@storeconfig')->name('store.config');
    Route::get('edit/krs/config/{id}','KrsController@editconfig')->name('config.edit');
    Route::post('update/krs/config/{id}','KrsController@updateconfig')->name('config.update');

    Route::resource('kelas', 'KelasController');
    Route::post('api/kelas','KelasController@kelaslist')->name('api.kelas');

    //krs

    Route::resource('matakuliah', 'MatakuliahController');
    Route::resource('mk', 'MkController');

    Route::post('mk/api', 'MkController@mklist')->name('mk.api');

      Route::post('mk/import', 'MkController@import')->name('import');

      Route::get('mk/import/data', function() {
        return view('admin::matakuliah.mk.import');

      })->name('mk.import');

    Route::post('api/mk','MatakuliahController@mklist')->name('api.mk');

    Route::resource('jadwal', 'JadwalController');
    Route::post('api/jadwal','JadwalController@jadwallist')->name('api.jadwal');


    Route::post('api/dosen','DosenController@dosenlist')->name('api.dosen');
    Route::post('api/mhs','MahasiswaController@mhs')->name('api.mhs');
    Route::post('api/kurikulum','KurikulumController@list')->name('api.kurikulum');
    Route::get('/modal/mhs/nilai','MahasiswaController@nilai')->name('modal.nilai');
    Route::get('/modal/mhs/ktm/{id}','MahasiswaController@ktm')->name('modal.ktm');
    Route::get('/modal/pndah/mhs/{id}','MahasiswaController@pindah')->name('modal.pindah');
    Route::post('postpindah/{id}','MahasiswaController@postpindah')->name('post.pindah');
    Route::get('tagihan/mhs/{id}','MahasiswaController@tagihan')->name('tagihan.mhs');
    Route::get('/xx','AdminController@home');
    Route::post('/psb/store', 'PsbController@create')->name('psbgelombang.store');
    Route::get('list/psb','PsbController@data_psb')->name('data.psb');
    Route::post('psb/delete','PsbController@hapus')->name('delete.psb');
    Route::post('psb/posting/','PsbController@storepsb')->name('posting.psb');
    Route::get('keuangan/kra', 'KeuanganController@kra')->name('kra.index');
    Route::get('keuangan/kra/create/{id}', 'KeuanganController@kracreate')->name('kra.edit');
    Route::post('keuangan/kra/store/{id}', 'KeuanganController@simpan1')->name('kra.simpan');
    Route::post('keuangan/kra/api','KeuanganController@kralist')->name('kra.list');
    Route::resource('keuangan1', 'KeuanganController');

    Route::group(['prefix' => 'keuangan'], function() {
        Route::resource('invoice','Keuangan\InvoiceController');
        Route::post('api/invoice','Keuangan\InvoiceController@list')->name('api.invoice');
        Route::get('get/mhs/{id}','Keuangan\InvoiceController@mhs');
        Route::resource('biaya','Keuangan\BiayaController');
        Route::post('api/biaya','Keuangan\BiayaController@list')->name('api.biaya');
        Route::resource('transaksi','Keuangan\TransaksiController');
        Route::get('transaksi/langsung/{id}','Keuangan\TransaksiController@langsung')->name('transaksi.langsung');
        Route::post('transaki/simpan','Keuangan\TransaksiController@simpan')->name('transaksi.simpan');
        Route::get('transaki/riwayat/{id}','Keuangan\TransaksiController@riwayat')->name('transaksi.invoice');
        Route::post('api/transaksi','Keuangan\TransaksiController@list')->name('api.transaksi');

    });

    Route::group(['prefix' => 'administrasi'], function () {
        Route::resource('realisasi', 'Administrasi\RealisasiController');
        Route::post('api/realisasi', 'Administrasi\RealisasiController@list')->name('api.realisasi');

    });


});
