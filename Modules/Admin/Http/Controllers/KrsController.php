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
      ->join('akademik','akademik.uuid','=','akademik_uuid')
      ->join('mahasiswa','mahasiswa.users_uuid','=','krs.users_uuid');
      // ->select('');
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
        return view('admin::create');
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
