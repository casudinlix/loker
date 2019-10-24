<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
//use Illuminate\Routing\Controller;
use Nwidart\Modules\Routing\Controller;
use DB;
use Carbon\Carbon;
use DataTables;

class KeuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('admin::index');
    }
    function kra()
    {
      $this->authorize('kra.index');
      $data=DB::table('kurikulum')->where('status', true)->get();
      return view('admin::keuangan.kra.index',compact('data'));
    }
    function kralist(Request $request)
      {
        $this->authorize('kra.index');
        $data=DB::table('mata_kuliah')
        ->join('kurikulum','kurikulum.uuid','=','mata_kuliah.kurikulum_uuid')
        ->join('mk','mk.uuid','=','mata_kuliah.mk_uuid')
        ->select('mata_kuliah.uuid','mk.name','mk.kode','mata_kuliah.status','mata_kuliah.harga','mata_kuliah.sks','mata_kuliah.smt','kurikulum.name as nama_kurikulum','mata_kuliah.harga');
        return Datatables::of($data)
        ->addIndexColumn()
        ->escapeColumns([])
        ->editColumn('harga', function ($data) {
        return "Rp. ".number_format($data->harga);
        })
        ->filter(function ($data) use ($request) {
            if ($request->has('kurikulum')) {
                $data->where('kurikulum_uuid', 'like', "%{$request->get('kurikulum')}%");
            }
          })
        ->addColumn('action', function ($data) {
          return '
          <div class="btn-group">
          <a href="#" data-toggle="dropdown" class="btn btn-xs btn-primary dropdown-toggle"><i class="fa fa-bars"></i>Option</a>
            <ul class="dropdown-menu" role="menu">
            <li><a href="'.route('kra.edit',[$data->uuid]).'" rel="modal:open">Ubah</a></li>
              <li><a href="#">Hapus</a></li>
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
        return view('admin::create');
    }
    function kracreate($id)
    {
      $data=DB::table('mata_kuliah')->where('uuid', $id)->first();

      return view('admin::keuangan.kra.edit',compact('data'));

    }
    function simpan(Request $request,$id)
    {
      DB::table('mata_kuliah')->where('uuid', $id)->update([
        'harga'=>$request->harga,
        'updated_at'=>Carbon::now(),
      ]);
      toastr()->success('Sukses', 'Sukses!');
      return redirect()->back();
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
      DB::table('mata_kuliah')->where('uuid', $id)->update([
        'harga'=>$request->harga,
        'updated_at'=>Carbon::now(),
      ]);
      toastr()->success('Sukses', 'Sukses!');
      return redirect()->back();
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
