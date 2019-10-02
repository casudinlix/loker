<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
//use Illuminate\Routing\Controller;
use Nwidart\Modules\Routing\Controller;
use DB;
use DataTables;
use Carbon\Carbon;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
      $this->authorize('config.kelas');
        return view('admin::kelas.index');
    }
    function kelaslist()
    {
      $this->authorize('config.kelas');
      $data=DB::table('kelas');

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
          <li><a href="'.route('kelas.edit',[$data->uuid]).'" rel="modal:open"><span class="fa fa-pencil"></span>Edit</a></li>

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
    public function create()
    {
        return view('admin::kelas.create');
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
              // all good
              DB::table('kelas')->insert([
                'uuid'=>unik(),
                'name'=>$request->nama,
                'kapasitas'=>$request->kapasitas,
                'created_by'=>getadmin(),
                'created_at'=>Carbon::now()
              ]);
              toastr()->success('Sukses', 'Sukses!');
              return redirect()->route('kelas.index');
          } catch (\Exception $e) {
              DB::rollback();
              echo $e->getMessage();
                  return false;
              return redirect()->back();
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
      $data=DB::table('kelas')->where('uuid', $id)->first();
        return view('admin::kelas.edit',compact('data'));
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
              // all good
              DB::table('kelas')->where('uuid', $id)->update([

                'name'=>$request->nama,
                'kapasitas'=>$request->kapasitas,
                'status'=>$request->status,
                'created_by'=>getadmin(),
                'updated_at'=>Carbon::now()
              ]);
              toastr()->success('Sukses', 'Sukses!');
              return redirect()->route('kelas.index');
          } catch (\Exception $e) {
              DB::rollback();
              echo $e->getMessage();
                  return false;
              return redirect()->back();
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
