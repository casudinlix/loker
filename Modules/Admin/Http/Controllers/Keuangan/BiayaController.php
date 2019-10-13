<?php

namespace Modules\Admin\Http\Controllers\Keuangan;
/**
 * A class to get information of application BiayaController
 * @author Casudin (com.casudin@gmail.com)
 * @version 1.0
 * @since 2019-10-12
 */
use Illuminate\Http\Request;
use Illuminate\Http\Response;
//use Illuminate\Routing\Controller;
use Nwidart\Modules\Routing\Controller;
use DB;
use Carbon\Carbon;
use DataTables;

class BiayaController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
      $this->authorize('keuangan.biaya');
        return view('admin::keuangan.biaya.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
     function list()
     {
       $this->authorize('keuangan.biaya');

       $data =DB::table('biaya');
       return Datatables::of($data)
       ->addIndexColumn()
       ->escapeColumns([])

       ->editColumn('created_at', function ($data) {
       return tgl_indo($data->created_at);
       })
       ->addColumn('action', function ($data) {
         return '
         <div class="btn-group">
         <a href="#" data-toggle="dropdown" class="btn btn-xs btn-primary dropdown-toggle"><i class="fa fa-bars"></i>Option</a>
           <ul class="dropdown-menu" role="menu">
           <li><a href="'.route('biaya.edit',[$data->uuid]).'" rel="modal:open"><span class="fa fa-pencil"></span>Edit</a></li>

             </ul>
             </div>';

   })
       ->editColumn('type', function ($data) {
          if ($data->type=='Pemasukan') {
            return '<span class="label label-info">Pemasukan</span>';
          } else {
            return '<span class="label label-danger">Pengeluaran</span>';
          }

      })
       ->make(true);
     }
    public function create()
    {
      return view('admin::keuangan.biaya.create');
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
              DB::table('biaya')->insert([
                'uuid'=>unik(),
                'name'=>$request->nama,
                'type'=>$request->type,
                'created_by'=>getadmin(),
                'created_at'=>Carbon::now()
              ]);
              toastr()->success('Sukses', 'Sukses!');
              return redirect()->back();
          } catch (\Exception $e) {
              DB::rollback();
              return $e->getMessage();
                  return false;
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
      $data=DB::table('biaya')->where('uuid',$id)->first();
      return view('admin::keuangan.biaya.edit',compact('data'));

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
              DB::table('biaya')->where('uuid',$id)->update([

                'name'=>$request->nama,
                'type'=>$request->type,
                'created_by'=>getadmin(),
                'updated_at'=>Carbon::now()
              ]);
              toastr()->success('Sukses', 'Sukses!');
              return redirect()->back();
          } catch (\Exception $e) {
              DB::rollback();
              return $e->getMessage();
                  return false;
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
