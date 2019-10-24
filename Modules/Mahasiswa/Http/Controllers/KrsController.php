<?php

namespace Modules\Mahasiswa\Http\Controllers;
/**
 * A class to get information of application KrsController
 * @author Casudin (com.casudin@gmail.com)
 * @version 1.0
 * @since 2019-10-22
 */
use Illuminate\Http\Request;
use Illuminate\Http\Response;
//use Illuminate\Routing\Controller;
use Nwidart\Modules\Routing\Controller;
use DB;
use Carbon\Carbon;
use DataTables;
use Auth;

class KrsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        if (krs()=='false') { //krs tutup
            return view('mahasiswa::krs.tutup');
        } elseif (invoice(Auth::user()->uuid)>0) {
            return view('mahasiswa::krs.belumbayar');
        }elseif (krs_ijin(Auth::user()->uuid)=='false' || krs_ijin(Auth::user()->uuid)=='kosong') {
            return view('mahasiswa::krs.tutup');
        }else {
            return view('mahasiswa::krs.index');
        }

        // if (krs()=='false') {
        //     return view('mahasiswa::krs.tutup');
        // }elseif(krs_ijin(Auth::user()->uuid)=='ok')
        // {
        //     return view('mahasiswa::krs.index');

        // }elseif(pembayaran(Auth::user()->uuid)=='ok')
        // {

        // }else{
        //     return view('mahasiswa::krs.index');

        // }

    }
        function list()
        {
            $data=DB::table('krs')
      ->join('akademik','akademik.uuid','=','krs.akademik_uuid')
      ->join('mahasiswa','mahasiswa.users_uuid','=','krs.users_uuid')
      ->join('users','users.uuid','=','mahasiswa.users_uuid')
      ->join('jadwal','jadwal.uuid','=','krs.jadwal_uuid')
      ->join('dosens','dosens.uuid','=','jadwal.dosen_uuid')
      ->join('mk','mk.uuid','=','jadwal.mk_uuid')
      ->where('krs.akademik_uuid',tahunakademik())->where('krs.users_uuid',Auth::user()->uuid)
       ->select('krs.uuid','krs.total_sks','jadwal.hari',
       'mk.name as nama_mk','jadwal.start','jadwal.end','mk.name as mk_name','akademik.name as nama_akademik');
      return Datatables::of($data)
      ->addIndexColumn()
      ->escapeColumns([])
      // ->editColumn('nama_jurusan', function ($data) {
      // return $data->nama_jurusan.' - '.$data->program_name;
      // })
      ->editColumn('created_at', function ($data) {
      return tgl_indo($data->created_at);
      })
      ->addColumn('action', function ($data) {
        return '
        <div class="btn-group">
        <a href="#" data-toggle="dropdown" class="btn btn-xs btn-primary dropdown-toggle"><i class="fa fa-bars"></i>Option</a>
          <ul class="dropdown-menu" role="menu">
          <li><a href="'.route('modal.nilai').'" rel="modal:open"><span class="fa fa-signal"></span>Nilai</a></li>

            </ul>
            </div>';

  })
      ->editColumn('status', function ($data) {
         if ($data->status==1) {
           return '<span class="label label-info">Active</span>';
         } else {
           return '<span class="label label-danger">Non Active</span>';
         }

     })
     ->editColumn('start', function ($data) {
       return $data->start.' - '.$data->end;

    })
      ->make(true);
        }
    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('mahasiswa::create');
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
        return view('mahasiswa::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('mahasiswa::edit');
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
