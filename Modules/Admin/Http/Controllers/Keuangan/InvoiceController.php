<?php

namespace Modules\Admin\Http\Controllers\Keuangan;
/**
 * A class to get information of application
 * @author Casudin (com.casudin@gmail.com)
 * @version 1.0
 * @since 2019-10-11
 */
use Illuminate\Http\Request;
use Illuminate\Http\Response;
//use Illuminate\Routing\Controller;
use Nwidart\Modules\Routing\Controller;
use DB;
use Carbon\Carbon;
use DataTables;
use App\User;
use Modules\Admin\Notifications\Invoice;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
      $this->authorize('keuangan.invoice');
        return view('admin::keuangan.invoice.index');
    }
    function list()
    {

             $data =DB::table('invoice')
             ->join('users','users.uuid','=','invoice.users_uuid')
             ->join('mahasiswa','mahasiswa.users_uuid','invoice.users_uuid')
             ->join('biaya','biaya.uuid','=','invoice.biaya_uuid')
             ->join('akademik','akademik.uuid','=','invoice.akademik_uuid')
             ->select('invoice.uuid','invoice.invoice_no','invoice.total_amount','invoice.total_amount as tagihan','invoice.status','invoice.due_date','invoice.created_by','invoice.update_by','users.name','mahasiswa.nim','invoice.created_at',
             'biaya.name as nama_biaya','invoice.potongan','akademik.name as nama_akademik')
             ;
             return Datatables::of($data)
             ->addIndexColumn()
             ->escapeColumns([])

             ->editColumn('created_at', function ($data) {
             return tgl_indo($data->created_at);
             })
             ->editColumn('due_date', function ($data) {
             return tgl_indo($data->due_date);
             })
             ->editColumn('potongan', function ($data) {
             return 'Rp. '.number_format($data->potongan);
             })
             ->editColumn('tagihan', function ($data) {
             return 'Rp. '.number_format($data->total_amount);
             })
             ->editColumn('total_amount', function ($data) {
             return 'Rp. '.number_format($data->total_amount - $data->potongan);
             })

             ->addColumn('action', function ($data) {
               if ($data->status=='Lunas'||$data->status=='Cancel by admin') {
                 return '';
               }else{
               return '
               <div class="btn-group">
               <a href="#" data-toggle="dropdown" class="btn btn-xs btn-primary dropdown-toggle"><i class="fa fa-bars"></i>Option</a>
                 <ul class="dropdown-menu" role="menu">
                 <li><a href="'.route('transaksi.langsung',[$data->uuid]).'" rel="modal:open"><span class="fa fa-dollar"></span>Bayar</a></li>
                 <li><a href="'.route('invoice.edit',[$data->uuid]).'"><span class="fa fa-pencil"></span>Edit</a></li>

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
      $this->authorize('create.invoice');
      $biaya=DB::table('biaya')->get();
      $angkatan=DB::table('mahasiswa')->distinct()->get(['angkatan']);
        return view('admin::keuangan.invoice.create',compact('biaya','angkatan'));

        // for ($i=0; $i <20 ; $i++) {
        //   return nomor('invoice','INV-'.date('ymd'));
        // }


    }
    function kode()
    {
      $kd="";
   $query = DB::table('invoice')
   ->select(DB::raw('MAX(RIGHT(invoice_no,4)) as kd_max'))
    ->whereDate('created_at',Carbon::today());
   if ($query->count()>0) {
    foreach ($query->get() as $key ) {
    $tmp = ((int)$key->kd_max)+1;
    $kd = sprintf("%04s", $tmp);
    }
   }else {
     $kd = "0001";
   }

    return  "INV-".date('dmy').$kd;
    }
    function mhs($id)
    {
     $data=DB::table('users')
     ->join('mahasiswa','mahasiswa.users_uuid','=','users.uuid')->where('angkatan',$id)
     ->select('users.uuid','mahasiswa.nim','users.name')
     ->get();

     return Response()->json($data);


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
              foreach ($request->mhs as $key => $value) {
                 DB::table('invoice')->insert([
                   'uuid'=>unik(),
                   'invoice_no'=>nomor('invoice','INV-'.date('ymd')),
                   'users_uuid'=>$value,
                   'akademik_uuid'=>tahunakademik(),
                   'due_date'=>$request->due_date,
                   'biaya_uuid'=>$request->biaya,
                   'total_amount'=>str_replace(',', '', $request->total_amount),
                   'created_at'=>Carbon::now(),
                   'created_by'=>getadmin(),
                   'ket'=>$request->ket,
                   'status'=>'Belum Bayar',
                   'potongan'=>str_replace(',', '', $request->potongan),
                 ]);
                 // $user=User::where('uuid',$value)->first();
                 // $invoice=DB::table('invoice')->where('', 'pattern')
                 // $data=[
                 //   'nama'=>$user->name,
                 //   'invoice_no'
                 // ];
                 //   $user->notify(new WelcomeDosen($data));
              }
              toastr()->success('Sukses', 'Sukses!');
              return redirect()->route('invoice.index');
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
      $x=DB::table('invoice')->where('uuid',$id)->first();
      if ($x->status=='Lunas'||$x->status=='Cancel by admin') {
        toastr()->error('Status tidak bisa di edit, Silahkan dibuatkan invoice baru', 'Error!');
        return redirect()->back();
      }else {
        $this->authorize('edit.invoice');
        $biaya=DB::table('biaya')->get();
        $angkatan=DB::table('mahasiswa')->distinct()->get(['angkatan']);
        $mhs=DB::table('mahasiswa')
        ->join('users','users.uuid','=','mahasiswa.users_uuid')
        ->where('users_uuid',$x->users_uuid)->first();

          return view('admin::keuangan.invoice.edit',compact('biaya','angkatan','x','mhs'));
      }

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
              DB::table('invoice')->where('uuid', $id)->update([

                'due_date'=>$request->due_date,
                'biaya_uuid'=>$request->biaya,
                'total_amount'=>str_replace(',', '', $request->total_amount),
                'updated_at'=>Carbon::now(),
                'update_by'=>getadmin(),
                'ket'=>$request->ket,
                'status'=>$request->status,
                'potongan'=>str_replace(',', '', $request->potongan),
              ]);
              toastr()->success('Sukses', 'Sukses!');
              return redirect()->route('invoice.index');
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
