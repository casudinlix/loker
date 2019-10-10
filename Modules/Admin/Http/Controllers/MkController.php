<?php

namespace Modules\Admin\Http\Controllers;
/**
 * A class to get information of application
 * @author Casudin (com.casudin@gmail.com)
 * @version 1.0
 * @since 2019-10-10
 */
use Illuminate\Http\Request;
use Illuminate\Http\Response;
//use Illuminate\Routing\Controller;
use Nwidart\Modules\Routing\Controller;
use DB;
use Carbon\Carbon;
use DataTables;
use Excel;
use App\Models\MkModel;
use App\Imports\MkImport;


class MkController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
      $this->authorize('master.mk');
        return view('admin::matakuliah.mk.index');
    }
    function mklist()
    {
      $this->authorize('master.mk');

      $data=DB::table('mk');
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
          <li><a href="'.route('mk.edit',$data->uuid).'" rel="modal:open">Ubah</a></li>
          <li><a onclick="hapus('."'$data->id'".')" >Hapus</a></li>


            </ul>
            </div>';

      })

      ->make(true);

    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
      return view('admin::matakuliah.mk.create');
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
              MkModel::create($request->all());
              toastr()->success('Sukses', 'Sukses!');
              return redirect()->back();
          } catch (\Exception $e) {
              DB::rollback();
              echo $e->getMessage();
                  return false;
              return redirect()->back();
          }
    }
      function import(Request $request)
      {


        DB::beginTransaction();

            try {
                DB::commit();

                $validatedData = $request->validate([
                      'file' => 'required|mimes:xls,xlsx,csv'
                ]);

                if ($request->hasFile('file')) {
                    $file = $request->file('file'); //GET FILE
                    Excel::import(new MkImport, request()->file('file')); //IMPORT FILE
                    toastr()->success('Sukses', 'Sukses!');
                    return redirect()->back();
                }else{
                  toastr()->error('Cek Kembali Format File ', 'Gagal!');
                  return redirect()->back();
                }
            } catch (\Exception $e) {
                DB::rollback();
              //  return ;
                toastr()->error($e->getMessage());
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
      $data=DB::table('mk')->where('uuid', $id)->first();
        return view('admin::matakuliah.mk.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {

                try {
                    DB::commit();
                    MkModel::where('uuid',$id)->update(['kode'=>$request->kode,'name'=>$request->name]);
                    toastr()->success('Sukses', 'Sukses!');
                    return redirect()->back();
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
        MkModel::destroy($id);

        return response()->json(['response'=>'success']);


    }
}
