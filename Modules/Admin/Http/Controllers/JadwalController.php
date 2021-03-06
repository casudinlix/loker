<?php

namespace Modules\Admin\Http\Controllers;
/**
 * A class to get information of application
 * @author Casudin (com.casudin@gmail.com)
 * @version 1.0
 * @since 2019-10-06
 */

use Illuminate\Http\Request;
use Illuminate\Http\Response;
//use Illuminate\Routing\Controller;
use Nwidart\Modules\Routing\Controller;
use DB;
use Carbon\Carbon;
use DataTables;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
      $this->authorize('akademik.jadwal');
        return view('admin::jadwal.index');
    }
    function jadwallist()
    {
      $data=DB::table('jadwal')
      ->join('akademik','akademik.uuid','=','jadwal.akademik_uuid')
      ->join('dosens','dosens.uuid','=','jadwal.dosen_uuid')
      ->join('mk','mk.uuid','=','jadwal.mk_uuid')
      ->join('kelas','kelas.uuid','=','jadwal.kelas_uuid')
      ->select('akademik.name as nama_akademik','mk.name as mk_name','dosens.name as nama_dosen','mk.name as nama_mk'
                ,'jadwal.hari','jadwal.uuid','jadwal.start','jadwal.end','jadwal.created_by as dibuat',
              'kelas.name as nama_kelas')->where('akademik.status',true);

      return Datatables::of($data)
      ->addIndexColumn()
      ->escapeColumns([])
      // ->editColumn('nama_jurusan', function ($data) {
      // return $data->nama_jurusan.' - '.$data->program_name;
      // })
      // ->editColumn('created_at', function ($data) {
      // return tgl_indo($data->created_at);
      // })
      ->addColumn('action', function ($data) {
        return '
        <div class="btn-group">
        <a href="#" data-toggle="dropdown" class="btn btn-xs btn-primary dropdown-toggle"><i class="fa fa-bars"></i>Option</a>
          <ul class="dropdown-menu" role="menu">
          <li><a href="'.route('jadwal.edit',[$data->uuid]).'" rel="modal:open"><span class="fa fa-pencil"></span>Edit</a></li>
          <li><a href="#" onclick="hapus('."'$data->uuid'".')"><span class="fa fa-trash-o"></span>Hapus</a></li>

            </ul>
            </div>';

      })
      // ->editColumn('status', function ($data) {
      //    if ($data->status==1) {
      //      return '<span class="label label-info">Active</span>';
      //    } else {
      //      return '<span class="label label-danger">Non Active</span>';
      //    }
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
        $dosen=DB::table('dosens')->get();
        $akademik=DB::table('akademik')->where('status', true)->first();
        $mk=DB::table('mk')->get();
        $kelas=DB::table('kelas')->where('status',true)->get();
        return view('admin::jadwal.buat',compact('dosen','akademik','mk','kelas'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
      DB::beginTransaction();

          try {
              DB::commit();

              // $input=[
              //
              // ];

              for ($i=0; $i <count($request->akademik) ; $i++) {
                if ($request->start[$i]>$request->end[$i] || $request->start[$i]== $request->end[$i]) {
                    toastr()->error('Error Cek Kembali Jam mulai Dan Jam Akhir', 'Error!');
                    return redirect()->route('jadwal.index');
                  }else{
                  DB::table('jadwal')->insert([
                    'uuid'=>unik(),
                    'akademik_uuid'=>$request->akademik[$i],
                    'dosen_uuid'=>$request->dosen[$i],
                    'mk_uuid'=>$request->mk[$i],
                    'hari'=>$request->hari[$i],
                    'start'=>$request->start[$i],
                    'kelas_uuid'=>$request->kelas[$i],
                    'end'=>$request->end[$i],
                    'created_by'=>getadmin(),
                    'created_at'=>Carbon::now()
                  ]);

                }

              }
              toastr()->success('Sukses', 'Sukses!');
              return redirect()->route('jadwal.index');

            // foreach ($request->mk as $key => $value) {
            //
            //   if ($request->start>$request->end || $request->start== $request->end) {
            //     toastr()->error('Error Cek Kembali Jam mulai Dan Jam Akhir', 'Error!');
            //     return redirect()->route('jadwal.index');
            //   }else {
                //dd($request->hari);
                //
                // DB::table('jadwal')->insert([
                //   'uuid'=>unik(),
                //   'akademik_uuid'=>$request->akademik,
                //   'dosen_uuid'=>$request->dosen,
                //   'mk_uuid'=>$request->mk,
                //   'hari'=>$request->hari,
                //   'start'=>$request->start,
                //   'kelas_uuid'=>$request->kelas,
                //   'end'=>$request->end,
                //   'created_by'=>getadmin(),
                //   'created_at'=>Carbon::now()
                // ]);
                // toastr()->success('Sukses', 'Sukses!');
                // return redirect()->route('jadwal.index');
            //   }
            // }
          } catch (\Exception $e) {
              DB::rollback();
              return $e->getMessage();

              //return redirect()->back();
          }
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
      $data=DB::table('jadwal')->where('uuid', $id)->first();
      $dosen=DB::table('dosens')->get();
      $akademik=DB::table('akademik')->where('status', true)->get();
      $mk=DB::table('mk')->get();
      $kelas=DB::table('kelas')->where('status',true)->get();

        return view('admin::jadwal.edit',compact('data','dosen','akademik','mk','kelas'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
      DB::beginTransaction();

          try {
              DB::commit();
              if ($request->start> $request->end || $request->start== $request->end) {
                toastr()->error('Error', 'Error!');
                return redirect()->route('jadwal.index');
              }else {
                DB::table('jadwal')->where('uuid',$id)->update([

                  'akademik_uuid'=>$request->akademik,
                  'dosen_uuid'=>$request->dosen,
                  'mk_uuid'=>$request->mk,
                  'hari'=>$request->hari,
                  'start'=>$request->start,
                  'kelas_uuid'=>$request->kelas,
                  'end'=>$request->end,
                  'created_by'=>getadmin(),
                  'updated_at'=>Carbon::now()
                ]);
                toastr()->success('Sukses', 'Sukses!');
                return redirect()->route('jadwal.index');

              }

          } catch (\Exception $e) {
              DB::rollback();
              return $e->getMessage();

              //return redirect()->back();
          }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
      DB::table('jadwal')->where('uuid',$id)->delete();

      return response()->json(['response'=>'success']);
    }
}
