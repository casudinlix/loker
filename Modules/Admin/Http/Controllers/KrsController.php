<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
//use Illuminate\Routing\Controller;
use Nwidart\Modules\Routing\Controller;
use DB;
use DataTables;
use Carbon\Carbon;

class KrsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
      $this->authorize('akademik.krs');

        return view('admin::krs.index-config');
    }
    function krsList()
    {
      $this->authorize('akademik.krs');
      $data=DB::table('krs')
      ->join('akademik','akademik.uuid','=','krs.akademik_uuid')
      ->join('mahasiswa','mahasiswa.users_uuid','=','krs.users_uuid')
      ->join('users','users.uuid','=','mahasiswa.users_uuid')
      ->join('jadwal','jadwal.uuid','=','krs.jadwal_uuid')
      ->join('dosens','dosens.uuid','=','jadwal.dosen_uuid')
      ->join('mk','mk.uuid','=','jadwal.mk_uuid')
      ->where('krs.akademik_uuid',tahunakademik())
       ->select('krs.uuid','krs.total_sks','jadwal.hari','mk.name as nama_mk','users.name as nama_mhs','mahasiswa.nim');
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
      ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     * @return Response
     */
     function krsconfig()
     {
       $this->authorize('akademik.krs');
       $data=DB::table('krs_config')
       ->join('akademik','akademik.uuid','=','krs_config.akademik_uuid')
       ->select('krs_config.uuid','krs_config.start_date','krs_config.due_date','krs_config.max_sks','akademik.name as nama_akademik','krs_config.created_by','krs_config.created_at');
       return Datatables::of($data)
       ->addIndexColumn()
       ->escapeColumns([])
       // ->editColumn('nama_jurusan', function ($data) {
       // return $data->nama_jurusan.' - '.$data->program_name;
       // })
       ->editColumn('start_date', function ($data) {
       return tgl_indo($data->start_date);
       })
       ->editColumn('due_date', function ($data) {
       return tgl_indo($data->due_date);
       })
       ->editColumn('created_at', function ($data) {
       return tgl_indo($data->created_at);
       })
       ->addColumn('action', function ($data) {
         return '
         <div class="btn-group">
         <a href="#" data-toggle="dropdown" class="btn btn-xs btn-primary dropdown-toggle"><i class="fa fa-bars"></i>Option</a>
           <ul class="dropdown-menu" role="menu">
           <li><a href="'.route('config.edit',[$data->uuid]).'" rel="modal:open"><span class="fa fa-pencil"></span>Edit</a></li>


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
     function krs_ijin()
     {
        $this->authorize('akademik.krs');
        $data=DB::table('krs_ijin')
        ->join('akademik','akademik.uuid','=','krs_ijin.akademik_uuid')
        ->join('users','users.uuid','=','krs_ijin.users_uuid')
        ->join('mahasiswa','mahasiswa.users_uuid','=','krs_ijin.users_uuid')
        ->select('krs_ijin.uuid','krs_ijin.start_date','krs_ijin.due_date',
        'krs_ijin.max_sks','akademik.name as nama_akademik','krs_ijin.created_by',
        'krs_ijin.created_at','mahasiswa.nim','users.name','krs_ijin.ket');
        return Datatables::of($data)
        ->addIndexColumn()
        ->escapeColumns([])
        // ->editColumn('nama_jurusan', function ($data) {
        // return $data->nama_jurusan.' - '.$data->program_name;
        // })
        ->editColumn('start_date', function ($data) {
        return tgl_indo($data->start_date);
        })
        ->editColumn('due_date', function ($data) {
        return tgl_indo($data->due_date);
        })
        ->editColumn('created_at', function ($data) {
        return tgl_indo($data->created_at);
        })
        ->addColumn('action', function ($data) {
          return '
          <div class="btn-group">
          <a href="#" data-toggle="dropdown" class="btn btn-xs btn-primary dropdown-toggle"><i class="fa fa-bars"></i>Option</a>
            <ul class="dropdown-menu" role="menu">
            <li><a  onclick="hapus('."'$data->uuid'".')"><span class="fa fa-trash"></span>Hapus</a></li>


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
     function create_ijin_krs()
     {
       $angkatan=DB::table('mahasiswa')->distinct()->get(['angkatan']);

        return view('admin::krs.ijin',compact('angkatan'));
     }
     function delete_ijin(Request $req)
     {
       DB::table('krs_ijin')->where('uuid', $req->uuid)->delete();
      return response()->json(['response'=>'success']);
     }
     function simpan_ijin(Request $request)
     {
       DB::beginTransaction();

           try {
               DB::commit();
               // all good
               foreach ($request->mhs as $key => $value) {
                 if ($request->start_date > $request->end_date) {
                   toastr()->error('error cek kembali Tanggal yang anda masukan!', 'Error');
                   return redirect()->back();
                 } else {
                   foreach ($request->mhs as $key => $value) {
                   DB::table('krs_ijin')->insert([
                     'uuid'=>unik(),
                     'users_uuid'=>$value,
                     'akademik_uuid'=>tahunakademik(),
                     'start_date'=>$request->start_date,
                     'due_date'=>$request->end_date,
                     'ket'=>$request->ket,
                     'max_sks'=>$request->max_sks,
                     'created_by'=>getadmin(),
                     'created_at'=>Carbon::now()
                   ]);
                 }
                   toastr()->success('Sukses', 'Sukses!');
                   return redirect()->back();
                 }

               }

           } catch (\Exception $e) {
               DB::rollback();
               echo $e->getMessage();
                   return false;
               return redirect()->back();
           }
     }
     function editconfig($id)
     {
       $akademik=DB::table('akademik')->where('status', true)->get();
       $data=DB::table('krs_config')->where('uuid', $id)->first();
         return view('admin::krs.edit-config',compact('data','akademik'));
     }
     function updateconfig(Request $request,$id)
     {
       DB::beginTransaction();

           try {
               DB::commit();
               if ($request->due_date < $request->start_date) {
                 toastr()->error('Pilih tanggal yang benar', 'Error!');
                 return redirect()->back();
               }else {
                 DB::table('krs_config')->where('uuid', $id)->update([

                 'akademik_uuid'=>$request->akademik,
                 'start_date'=>$request->start_date,
                 'due_date'=>$request->due_date,
                 'max_sks'=>$request->max_sks,
                 'created_by'=>getadmin(),
                 'updated_at'=>Carbon::now()
                 ]);
                 toastr()->success('Sukses', 'Sukses!');
                  return redirect()->route('krs.index');
               }

           } catch (\Exception $e) {
               DB::rollback();
               echo $e->getMessage();
                   return false;
               return redirect()->back();
           }
     }
    public function create()
    {
        $mhs=DB::table('users')
        ->join('mahasiswa','mahasiswa.users_uuid','=','users.uuid');
        $jdwl=DB::table('jadwal')
        ->join('mk','mk.uuid','jadwal.mk_uuid')
        ->join('mata_kuliah','mata_kuliah.mk_uuid','=','jadwal.mk_uuid')
        ->join('dosens','dosens.uuid','=','jadwal.dosen_uuid')
        ->join('kelas','kelas.uuid','jadwal.kelas_uuid')
        ->select('mk.name as nama_mk','mata_kuliah.sks','mata_kuliah.smt','jadwal.hari','jadwal.start','jadwal.end','dosens.name as nama_dosen',
        'kelas.name as nama_kelas')
        ->where('jadwal.akademik_uuid',tahunakademik())->get();

        return view('admin::krs.tambah_manual',compact('mhs','jdwl'));
    }
    function createkrsconfig()
    {
      $data=DB::table('akademik')->where('status', true)->get();
        return view('admin::krs.create-config',compact('data'));
    }
    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
     function storeconfig(Request $request)
     {
       DB::beginTransaction();

           try {
               DB::commit();
               if ($request->due_date < $request->start_date) {
                 toastr()->error('Pilih tanggal yang benar', 'Error!');
                 return redirect()->back();
               }else {
                 DB::table('krs_config')->insert([
                 'uuid'=>unik(),
                 'akademik_uuid'=>$request->akademik,
                 'start_date'=>$request->start_date,
                 'due_date'=>$request->due_date,
                 'max_sks'=>$request->max_sks,
                 'created_by'=>getadmin(),
                 'created_at'=>Carbon::now()
                 ]);
                 toastr()->success('Sukses', 'Sukses!');
                 return redirect()->route('krs.index');
               }

           } catch (\Exception $e) {
               DB::rollback();
               echo $e->getMessage();
                   return false;
               return redirect()->back();
           }
     }
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
