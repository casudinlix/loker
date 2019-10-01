<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
//use Illuminate\Routing\Controller;
use Nwidart\Modules\Routing\Controller;
use DB;
use DataTables;
use Carbon\Carbon;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
      $this->authorize('akademik.mahasiswa');
        return view('admin::mahasiswa.index');
    }
    function mhs()
    {
      $this->authorize('akademik.mahasiswa');
      $data=DB::table('users')->join('mahasiswa','mahasiswa.users_uuid','=','users.uuid')
      ->join('jurusan','mahasiswa.jurusan_uuid','=','jurusan.uuid')
      ->join('profile','profile.users_uuid','=','users.uuid')
      ->join('kurikulum','kurikulum.uuid','=','mahasiswa.kurikulum_uuid')
      ->select(
        'users.uuid','users.name','users.status','mahasiswa.nim','mahasiswa.angkatan','jurusan.program_name','jurusan.name as nama_jurusan','mahasiswa.nim',
        'profile.tlp','kurikulum.name as kurikulum_name'
        )->where('users.status',true)
      ;
      return Datatables::of($data)
      ->addIndexColumn()
      ->escapeColumns([])
      ->editColumn('nama_jurusan', function ($data) {
      return $data->nama_jurusan.' - '.$data->program_name;
      })
      // ->filter(function ($data) use ($request) {
      //     if ($request->has('kurikulum')) {
      //         $data->where('kurikulum_uuid', 'like', "%{$request->get('kurikulum')}%");
      //     }
      //   })
      ->addColumn('action', function ($data) {
        return '
        <div class="btn-group">
        <a href="#" data-toggle="dropdown" class="btn btn-xs btn-primary dropdown-toggle"><i class="fa fa-bars"></i>Option</a>
          <ul class="dropdown-menu" role="menu">
          <li><a href="'.route('modal.nilai').'" rel="modal:open"><span class="fa fa-signal"></span>Nilai</a></li>
          <li><a href="'.$data->uuid.'"><span class="fa fa-user"></span>Profile</a></li>
          <li><a href="'.route('modal.ktm',[$data->uuid]).'" rel="modal:open"><span class="fa fa-search-plus"></span>KTM</a></li>
          <li><a href="'.$data->uuid.'"><span class="fa fa-money"></span>Tagihan</a></li>
          <li><a href="'.route('modal.pindah',[$data->uuid]).'" rel="modal:open"><span class="fa fa-location-arrow"></span>Pindah Jurusan</a></li>

            </ul>
            </div>';

  })
     //  ->editColumn('status', function ($data) {
     //     if ($data->status==1) {
     //       return '<span class="label label-info">Active</span>';
     //     } else {
     //       return '<span class="label label-danger">Non Active</span>';
     //     }
     //
     // })
      ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
     function nilai()
     {
       return view('admin::mahasiswa.modal.nilai');
     }
     function ktm($id)
     {
       $data=DB::table('users')->join('mahasiswa','mahasiswa.users_uuid','=','users.uuid')
       ->join('jurusan','mahasiswa.jurusan_uuid','=','jurusan.uuid')
       ->join('profile','profile.users_uuid','=','users.uuid')
       ->select(
         'users.uuid','users.name','users.status','mahasiswa.nim','mahasiswa.angkatan','jurusan.program_name','jurusan.name as nama_jurusan','mahasiswa.nim',
         'profile.tlp','profile.avatar','profile.blood_type'
         )->where('users.status',true)->first()
       ;
       return view('admin::mahasiswa.modal.ktm',compact('data'));

     }
    public function pindah($id)
    {
      $data=DB::table('users')->join('mahasiswa','mahasiswa.users_uuid','=','users.uuid')
      ->join('jurusan','mahasiswa.jurusan_uuid','=','jurusan.uuid')
      ->join('profile','profile.users_uuid','=','users.uuid')
      ->select(
        'users.uuid','users.name','users.status','mahasiswa.jurusan_uuid','mahasiswa.kurikulum_uuid','jurusan.program_name','jurusan.name as nama_jurusan','mahasiswa.nim',
        'profile.tlp','profile.avatar','profile.blood_type'
        )->where('users.status',true)->where('mahasiswa.users_uuid',$id)->first();
         $jurusan=DB::table('jurusan')->get();
         $kurikulum=DB::table('kurikulum')->where('status', true)->get();
        return view('admin::mahasiswa.modal.pindah',compact('data','jurusan','kurikulum'));
    }
    function postpindah(Request $request,$id)
    {

      DB::beginTransaction();

          try {
              DB::commit();
              $angkatan=DB::table('mahasiswa')->where('users_uuid', $id)->first();
              $jurusan=DB::table('jurusan')->where('uuid', $request->jurusan)->first();
              $total1=DB::table('mahasiswa')->where('angkatan', $angkatan->angkatan)->count();
              if ($total1==1) {
                $total=1;
              }else{
                $total+1;
              }
             $counter = str_pad($total, 3, "0", STR_PAD_LEFT);
              $nim= $angkatan->angkatan.$jurusan->kode.$counter;
              DB::table('mahasiswa')->where('users_uuid',$id)->update([
                'nim'=>$nim,
                'jurusan_uuid'=>$request->jurusan,
                'kurikulum_uuid'=>$request->kurikulum,
                'updated_at'=>Carbon::now()
              ]);
              toastr()->success('Silahkan Masukan Token Anda Terlebih Dahulu', 'Sukses!');
              return redirect()->back();
          } catch (\Exception $e) {
              DB::rollback();
              echo $e->getMessage();
                  return false;
              return redirect()->back();
          }

    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('admin::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('admin::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
