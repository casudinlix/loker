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
use DataTables;
use Carbon\Carbon;
use Modules\Admin\Entities\DosenModel;
use Modules\Admin\Notifications\WelcomeDosen;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
      $this->authorize('akademik.dosen');
        return view('admin::dosen.index');
    }
  function dosenlist()
  {
    $data=DB::table('dosens');
    return Datatables::of($data)
    ->addIndexColumn()
    ->escapeColumns([])

    // ->filter(function ($data) use ($request) {
    //     if ($request->has('kurikulum')) {
    //         $data->where('kurikulum_uuid', 'like', "%{$request->get('kurikulum')}%");
    //     }
    //   })
    ->addColumn('action', function ($data) {
      return '
      <div class="btn-group">
      <a href="#" data-toggle="dropdown" class="btn btn-xs btn-primary dropdown-toggle"><i class="fa fa-bars"></i>Option</a>
        <ul class="dropdown-menu" role="menu">

        <li><a href="'.route('dosen.edit',[$data->uuid]).'" rel="modal:open"><span class="fa fa-pencil"></span>Edit</a></li>
        <li><a href="'.$data->uuid.'"><span class="fa fa-lock"></span>Reset Password</a></li>

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
        return view('admin::dosen.create');
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
              $password= rand(10000, 99999);
              DB::table('dosens')->insert([
                'uuid'=>unik(),
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>bcrypt($password),
                'status'=>true,
                'created_by'=>getadmin(),
                'created_at'=>Carbon::now(),

              ]);
              $user=DosenModel::where('email',$request->email)->first();

              $data=[
                'name'=>$request->nama,
                'email'=>$request->email,
                'password'=>$password
              ];
              $user->notify(new WelcomeDosen($data));
              toastr()->success('Berhasil Entri Data', 'Sukses!');
              return redirect()->back();
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
      $data=DB::table('dosens')->where('uuid',$id)->first();

        return view('admin::dosen.edit',compact('data'));
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
              DB::table('dosens')->where('uuid',$id)->update([
                'email'=>$request->email,
                'name'=>$request->name,
              ]);
              toastr()->success('Berhasil Update', 'Sukses!');
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
