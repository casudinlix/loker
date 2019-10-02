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
         )->where('kurikulum.status',true)
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
