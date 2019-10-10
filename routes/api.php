<?php

use Illuminate\Http\Request;
use App\Models\Provinsi;
use App\Models\Kota;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Mk;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function () {
//     //return $request->user();
//     return "HEllo";
// });
Route::group(['prefix' => 'v1/public'], function () {
  Route::get('kota/{id}',function($id){
          $data=Kota::where('province_id',$id)->get();
          return Response()->json($data);

  })->name('api.kota');
  Route::get('kecamatan/{id}',function($id){
    $data=Kecamatan::where('city_id',$id)->get();
    return Response()->json($data);

  })->name('api.kecamatan');
  Route::get('kelurahan/{id}',function($id){
      $data=Kelurahan::where('district_id',$id)->get();
      return Response()->json($data);

  })->name('api.kelurahan');

  Route::get('mk/{id}', function($id) {
      $data=Mk::where('kurikulum_uuid',$id)->get();
      return Response()->json($data);
  })->name('mk.api');


});
