<?php

namespace Modules\Admin\Http\Controllers\Administrasi;
/**
 * A class to get information of application RealisasiController
 * @author Casudin (com.casudin@gmail.com)
 * @version 1.0
 * @since 2019-10-20
 */
use Illuminate\Http\Request;
use Illuminate\Http\Response;
//use Illuminate\Routing\Controller;
use Nwidart\Modules\Routing\Controller;
use DB;
use Carbon\Carbon;
use DataTables;

class RealisasiController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $this->authorize('administrasi.realisasi');
        return view('admin::administrasi.realisasi.index');
    }
    function list()
    {
        $this->authorize('administrasi.realisasi');
        $data=DB::table('realisasi_mengajar')
        ->join('jadwal','jadwal.uuid','=','realisasi_mengajar.jadwal_uuid')
        ->join('akademik','akademik.uuid','=','jadwal.akademik_uuid')
        ->join('dosens','dosens.uuid','=','jadwal.dosen_uuid')
        ->join('mk','mk.uuid','=','jadwal.mk_uuid')
        ->select('realisasi_mengajar.uuid','realisasi_mengajar.pokok_bahasan','realisasi_mengajar.mhs_hadir','realisasi_mengajar.mhs_alpa','realisasi_mengajar.paraf_dosen',
        'realisasi_mengajar.paraf_baak','realisasi_mengajar.paraf_keuangan',
        'akademik.name as nama_akademik','jadwal.')
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
            <li><a href="'.route('tagihan.mhs',$data->uuid).'" rel="modal:open"><span class="fa fa-money"></span>Tagihan</a></li>
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
    public function create()
    {
        return view('admin::create');
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
