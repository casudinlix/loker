<?php

namespace Modules\Config\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
//use Illuminate\Routing\Controller;
use DB;
use Carbon\Carbon;
use DataTables;
use Nwidart\Modules\Routing\Controller;

class AjaxConfigController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function api_akademik()
    {
        $data=DB::table('akademik');
        return Datatables::of($data)
        ->addIndexColumn()
        ->escapeColumns([])
        ->addColumn('action', function ($data) {
          return '
          <div class="btn-group">
          <a href="#" data-toggle="dropdown" class="btn btn-xs btn-primary dropdown-toggle"><i class="fa fa-bars"></i>Option</a>
            <ul class="dropdown-menu" role="menu">
            <li><a href="'.$data->uuid.'">Ubah</a></li>
              <li><a href="#">Hapus</a></li>
              </ul>
              </div>';
            })->editColumn('start_date', function ($data) {
            return tgl_indo($data->start_date);
        })
        ->editColumn('end_date', function ($data) {
        return tgl_indo($data->end_date);
    })
        ->editColumn('status', function ($data) {
           if ($data->status==1) {
             return '<span class="label label-info">Active</span>';
           } else {
             return '<span class="label label-danger">Non Active</span>';
           }

       })
        ->make(true);
        ;
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('config::create');
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
        return view('config::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('config::edit');
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
