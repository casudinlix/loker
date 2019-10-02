<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
//use Illuminate\Routing\Controller;
use Nwidart\Modules\Routing\Controller;
use DB;
use Carbon\Carbon;
use DataTables;


class MatakuliahController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
      $this->authorize('akademik.mk');
        $data=DB::table('kurikulum')->where('status', true)->get();
        return view('admin::matakuliah.index',compact('data'));
    }
    function mklist(Request $request)
    {
      $data=DB::table('mata_kuliah')->join('kurikulum','kurikulum.uuid','=','mata_kuliah.kurikulum_uuid')
      ->select('mata_kuliah.uuid','mata_kuliah.kode','mata_kuliah.name','mata_kuliah.status','mata_kuliah.sks','mata_kuliah.smt','kurikulum.name as nama_kurikulum','mata_kuliah.harga');
      return Datatables::of($data)
      ->addIndexColumn()
      ->escapeColumns([])

      ->filter(function ($data) use ($request) {
          if ($request->has('kurikulum')) {
              $data->where('mata_kuliah.kurikulum_uuid', 'like', "%{$request->get('kurikulum')}%");
          }
          if ($request->has('matakuliah')) {
                    $data->where('mata_kuliah.name', 'like', "%{$request->get('matakuliah')}%");
                }

        })
      ->addColumn('action', function ($data) {
        return '
        <div class="btn-group">
        <a href="#" data-toggle="dropdown" class="btn btn-xs btn-primary dropdown-toggle"><i class="fa fa-bars"></i>Option</a>
          <ul class="dropdown-menu" role="menu">
          <li><a href="'.route('matakuliah.edit',[$data->uuid]).'" rel="modal:open">Ubah</a></li>
            <li><a href="'.route('matakuliah.destroy',[$data->uuid]).'"">Hapus</a></li>
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
      $kurikulum=DB::table('kurikulum')->get();
        return view('admin::matakuliah.create',compact('kurikulum'));
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
              DB::table('mata_kuliah')->insert([
                'uuid'=>unik(),
                'kurikulum_uuid'=>$request->kurikulum,
                'kode'=>$request->kode,
                'name'=>$request->nama,
                'sks'=>$request->sks,
                'smt'=>$request->smt,
                'created_by'=>getadmin(),
                'status'=>true,
                'created_at'=>Carbon::now(),

              ]);
              toastr()->success('Sukses', 'Sukses!');
              return redirect()->route('matakuliah.index');
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
      DB::table('mata_kuliah')->where('uuid', $id)->delete();
      toastr()->success('Sukses', 'Sukses!');
      return redirect()->route('matakuliah.index');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
      $kurikulum=DB::table('kurikulum')->get();
      $data=DB::table('mata_kuliah')->where('uuid', $id)->first();

        return view('admin::matakuliah.edit',compact('kurikulum','data'));
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
              DB::table('mata_kuliah')->where('uuid', $id)->update([

                'kurikulum_uuid'=>$request->kurikulum,
                'kode'=>$request->kode,
                'name'=>$request->nama,
                'sks'=>$request->sks,
                'smt'=>$request->smt,
                'created_by'=>getadmin(),
                'status'=>$request->status,
                'updated_at'=>Carbon::now(),

              ]);
              toastr()->success('Sukses', 'Sukses!');
              return redirect()->route('matakuliah.index');
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
        DB::table('mata_kuliah')->where('uuid', $id)->delete();
        toastr()->success('Sukses', 'Sukses!');
        return redirect()->route('matakuliah.index');
    }
}
