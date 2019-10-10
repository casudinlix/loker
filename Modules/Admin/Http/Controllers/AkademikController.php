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

class AkademikController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
      $this->authorize('akademik.index');
        return view('admin::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
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
      DB::beginTransaction();

          try {
              DB::commit();
              // all good
              DB::table('akademik')->insert([
                'uuid'=>unik(),
                'kode'=>$request->kode,
                'name'=>$request->nama,
                'ket'=>$request->ket,
                'start_date'=>$request->start_date,
                'end_date'=>$request->end_date,
                'status'=>true,
                'created_by'=>getadmin(),
                'created_at'=>Carbon::now()
              ]);
              toastr()->success('Berhasil Entry Data', 'Sukses!');
              return redirect()->back();
          } catch (\Exception $e) {
              DB::rollback();
              return $e->getMessage();
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
      DB::beginTransaction();

          try {
              DB::commit();
              // all good
              DB::table('akademik')->where('uuid', $id)->update([

                'kode'=>$request->kode,
                'name'=>$request->nama,
                'ket'=>$request->ket,
                'start_date'=>$request->start_date,
                'end_date'=>$request->end_date,
                'status'=>$request->status,
                'created_by'=>getadmin(),
                'updated_at'=>Carbon::now()
              ]);
              toastr()->success('Berhasil Update Data', 'Sukses!');
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
