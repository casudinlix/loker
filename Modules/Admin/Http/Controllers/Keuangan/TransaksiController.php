<?php

namespace Modules\Admin\Http\Controllers\Keuangan;
/**
 * A class to get information of application TransaksiController
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

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('admin::index');
    }
    function list()
    {

    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('admin::create');
    }
    function langsung($id)
    {
      $inv=DB::table('invoice')->where('uuid', $id)
      ->first();
      $tran=DB::table('transaksi')->where('invoice_uuid', $id)->get();
      $user=DB::table('mahasiswa')
      ->join('users','users.uuid','=','mahasiswa.users_uuid')->where('users_uuid',$inv->users_uuid)->first();
      return view('admin::keuangan.transaksi.langsung',compact('inv','user','tran'));
    }
    function simpan(Request $request)
    {
      DB::beginTransaction();

          try {
              DB::commit();
              $inv=DB::table('invoice')->where('uuid', $request->invoice)->first();
              $total=$inv->total_amount-$inv->potongan;
              if ($request->sisa==0) {

                DB::table('invoice')->where('uuid', $request->invoice)->update(['status'=>'Lunas']);
              }elseif ($request->sisa<0) {
                toastr()->error('Cek Kembali Nominal yang anda input', 'Error!');
                return redirect()->back();

              }elseif ($total>$request->total_bayar) {
                DB::table('invoice')->where('uuid', $request->invoice)->update(['status'=>'Partial']);

              }
              DB::table('transaksi')->insert([
                'uuid'=>unik(),
                'tran_no'=>$this->kode(),
                'invoice_uuid'=>$request->invoice,
                'type'=>$request->type,
                'bank'=>$request->bank,
                'users_uuid'=>$request->users_uuid,
                'total_bayar'=>$request->total_bayar,
                'created_by'=>getadmin(),
                'created_at'=>Carbon::now(),
              ]);

              toastr()->success('Sukses', 'Sukses!');
              return redirect()->back();
          } catch (\Exception $e) {
              DB::rollback();
              echo $e->getMessage();
                  return false;
              return redirect()->back();
          }
    }
    function kode()
    {
      return nomor('transaksi',date('ymd'));
    }
    function riwayat($id)
    {
      $data=DB::table('transaksi')->where('invoice_uuid',$id)->get();
      $inv=DB::table('invoice')->where('uuid', $id)->first();
      $mhs=DB::table('mahasiswa')->join('users','users.uuid','=','mahasiswa.users_uuid')->where('users.uuid',$inv->users_uuid)->first();
      return view('admin::keuangan.transaksi.riwayat',compact('data','inv','mhs'));

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
