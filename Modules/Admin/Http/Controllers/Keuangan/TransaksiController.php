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
      $this->authorize('keuangan.transaksi');
        return view('admin::keuangan.transaksi.index');
    }
    function list()
    {
      $this->authorize('keuangan.transaksi');

      $data =DB::table('transaksi')
      ->join('invoice','invoice.uuid','=','transaksi.invoice_uuid')
      ->join('users','users.uuid','=','transaksi.users_uuid')
      ->join('mahasiswa','mahasiswa.users_uuid','=','transaksi.users_uuid')
        ->select('transaksi.uuid','transaksi.type','invoice.total_amount','invoice.invoice_no','transaksi.bank','transaksi.tran_no','transaksi.type','mahasiswa.nim','users.name','transaksi.total_bayar',
                'transaksi.created_by','transaksi.created_at','transaksi.status','transaksi.updated_by');
      return Datatables::of($data)
      ->addIndexColumn()
      ->escapeColumns([])

      ->editColumn('created_at', function ($data) {
      return tgl_indo($data->created_at);
      })
      ->editColumn('type', function ($data) {
      return $data->type." ".$data->bank;
      })

      ->editColumn('total_bayar', function ($data) {
      return 'Rp. '.number_format($data->total_bayar);
      })
      ->editColumn('status', function ($data) {
        if ($data->status=='On Proses') {
          return '<span class="label label-warning">On Proses</span>';
        }elseif ($data->status=='Verified') {
          return '<span class="label label-success">Verified</span>';
        }elseif ($data->status=='Reject') {
          return '<span class="label label-danger">Reject</span>';
        }
        })
      ->addColumn('action', function ($data) {

        if ($data->status=='Verified') {
            return '';
        }elseif ($data->status=='Reject') {
            return '';
        }else{
            return '
        <div class="btn-group">
        <a href="#" data-toggle="dropdown" class="btn btn-xs btn-primary dropdown-toggle"><i class="fa fa-bars"></i>Option</a>
          <ul class="dropdown-menu" role="menu">
          <li><a href="'.route('transaksi.edit', [$data->uuid]).'" data-toggle="modal" data-target="#edit" data-remote="false"><span class="fa fa-search"></span>Lihat</a></li>

            </ul>
            </div>';
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
              //$request->file('file');
              $file=$request->file('file')->store('public/lampiran');

              DB::table('transaksi')->insert([
                'uuid'=>unik(),
                'tran_no'=>$this->kode(),
                'invoice_uuid'=>$request->invoice,
                'type'=>$request->type,
                'bank'=>$request->bank,
                'users_uuid'=>$request->users_uuid,
                'total_bayar'=>$request->total_bayar,
                'status'=>$request->status,
                'file'=>$file,
                'created_by'=>getadmin(),
                'created_at'=>Carbon::now(),
              ]);
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
        $totalbayar=DB::table('transaksi')->select(DB::raw('SUM(total_bayar) as total_bayar'))->where('invoice_uuid',$id)->where('status','Verified')->first();
      $mhs=DB::table('mahasiswa')->join('users','users.uuid','=','mahasiswa.users_uuid')->where('users.uuid',$inv->users_uuid)->first();

      return view('admin::keuangan.transaksi.riwayat',compact('data','inv','mhs','totalbayar'));

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
        $data=DB::table('transaksi')->where('uuid',$id)->first();
        return view('admin::keuangan.transaksi.edit',compact('data'));
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
            DB::table('transaksi')->where('uuid',$id)->update([
                'status'=>$request->status,
                'updated_by'=>getadmin(),
                'updated_at'=>Carbon::now()
            ]);
            if ($request->status=='Reject') {
                DB::table('transaksi')->where('uuid',$id)->update([
                    'total_bayar'=>0,
                    'updated_by'=>getadmin(),
                    'updated_at'=>Carbon::now()
                ]);
            }

            toastr()->success('Sukses', 'Sukses!');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            // echo $e->getMessage();
            //     return false;
            toastr()->error($e->getMessage(), 'Error!');
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
