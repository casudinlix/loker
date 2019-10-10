<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
//use Illuminate\Routing\Controller;
use Nwidart\Modules\Routing\Controller;
use DB;
use DataTables;
use Carbon\Carbon;

class KurikulumController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
      $this->authorize('akademik.kurikulum');
        return view('admin::kurikulum.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
     function list()
     {
       $this->authorize('akademik.kurikulum');

       $data=DB::table('kurikulum')
       ->join('jurusan','jurusan.uuid','=','kurikulum.jurusan_uuid')

       ->select(
         'kurikulum.uuid','kurikulum.name','kurikulum.status','jurusan.program_name','jurusan.name as nama_jurusan',
         'kurikulum.name as kurikulum_name','kurikulum.created_by','kurikulum.created_at'
         )
       ;
       return Datatables::of($data)
       ->addIndexColumn()
       ->escapeColumns([])
       ->editColumn('nama_jurusan', function ($data) {
       return $data->nama_jurusan.' - '.$data->program_name;
       })
       ->editColumn('created_at', function ($data) {
       return tgl_indo($data->created_at);
       })
       ->addColumn('action', function ($data) {
         return '
         <div class="btn-group">
         <a href="#" data-toggle="dropdown" class="btn btn-xs btn-primary dropdown-toggle"><i class="fa fa-bars"></i>Option</a>
           <ul class="dropdown-menu" role="menu">
           <li><a href="'.route('kurikulum.edit',[$data->uuid]).'" rel="modal:open"><span class="fa fa-pencil"></span>Edit</a></li>

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
    public function create()
    {
      $jurusan=DB::table('jurusan')->get();
        return view('admin::kurikulum.create',compact('jurusan'));
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
              DB::table('kurikulum')->insert([
                'uuid'=>unik(),
                'name'=>$request->nama,
                'jurusan_uuid'=>$request->jurusan,
                'status'=>true,
                'created_by'=>getadmin()
              ]);
              toastr()->success('Sukses', 'Sukses!');
              return redirect()->back();
          } catch (\Exception $e) {
              DB::rollback();
              return $e->getMessage();
              //    return false;
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
      $data=DB::table('kurikulum')->where('uuid', $id)->first();
      $jurusan=DB::table('jurusan')->get();
        return view('admin::kurikulum.edit',compact('data','jurusan'));
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
              DB::table('kurikulum')->where('uuid', $id)->update([

                'name'=>$request->nama,
                'jurusan_uuid'=>$request->jurusan,
                'status'=>$request->status,
                'created_by'=>getadmin()
              ]);
              toastr()->success('Sukses', 'Sukses!');
              return redirect()->back();
          } catch (\Exception $e) {
              DB::rollback();
              return $e->getMessage();
              //    return false;
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
        //
    }
}
