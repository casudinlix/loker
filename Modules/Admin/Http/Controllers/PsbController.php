<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
//use Illuminate\Routing\Controller;
use Nwidart\Modules\Routing\Controller;
use DB;
use Carbon\Carbon;
use App\User;
use App\Notifications\UserWelcome;

class PsbController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
      $this->authorize('psb.index');

      $gelombang= DB::table('psb_gelombang')->join('akademik' ,'akademik.uuid','=','psb_gelombang.akademik_uuid')
      ->select('psb_gelombang.uuid','psb_gelombang.akademik_uuid','akademik.kode','psb_gelombang.name','psb_gelombang.created_by','psb_gelombang.prefix','psb_gelombang.status','akademik.name as nama_akademik')
      ->where('psb_gelombang.status',true)->get();
        $akademik=DB::table('akademik')->where('status',true)->get();
        $baru=DB::table('psb')->where('status',true)->where('daftar_ulang',false)->where('jenis','Baru')->count();
        $pindahan=DB::table('psb')->where('status',true)->where('daftar_ulang',false)->where('jenis','Pindahan')->count();
        $alumni=DB::table('psb')->where('status',true)->where('daftar_ulang',false)->where('jenis','Alumni')->count();
        $allakademik=DB::table('akademik')->get();
        return view('admin::psb.index',compact('gelombang','akademik','baru','pindahan','alumni','allakademik'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(Request $request)
    {
      DB::beginTransaction();

          try {
              DB::commit();
              DB::table('psb_gelombang')->insert([
                'uuid'=>unik(),
                'akademik_uuid'=>$request->akademik,
                'name'=>$request->nama,
                'prefix'=>$request->prefix,
                'status'=>true,
                'created_by'=>getadmin(),
                'created_at'=>Carbon::now()
              ]);
              toastr()->success('Sukses Disimpan');
              return redirect()->back();
          } catch (\Exception $e) {
              DB::rollback();
              echo $e->getMessage();
                  return false;
              return redirect()->back();
          }
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

            $data=[
              'nik'=>$request->nik,
              'nama'=>$request->nama,
              'tempatlahir'=>$request->tempatlahir,
              'agama'=>$request->agama,
              'tgl_lahir'=>$request->tgl_lahir,
              'tlp'=>$request->tlp,
              'email'=>$request->email,

            ];
            $gelombang=DB::table('psb_gelombang')->where('uuid',$request->gelombang)->first();
            $akademik=DB::table('akademik')->where('uuid', $gelombang->akademik_uuid)->first();
            DB::table('psb')->insert([
              'uuid'=>unik(),
              'no_psb'=>$this->nopsb($request->gelombang,$akademik->kode),
              'data'=>json_encode($data),
              'jenis'=>$request->jenis,
              'status'=>true,
              'daftar_ulang'=>false,
              'gelombang'=>$akademik->kode,
              'created_by'=>getadmin(),
              'created_at'=>Carbon::now(),

            ]);
              toastr()->success('Berhasil Menambah Data', 'Sukses!');
              return redirect()->back();
          } catch (\Exception $e) {
              DB::rollback();
              echo $e->getMessage();
                  return false;
              return redirect()->back();
          }

    }
    function nopsb($a,$b)
    {
      DB::beginTransaction();

          try {
              DB::commit();
              $kd="";
              $gelombang=DB::table('psb_gelombang')->where('uuid',$a)->where('status', true)->first();
              $jumlah=DB::table('psb')->where('gelombang',$b)->count();

              $counter = str_pad($jumlah+1, 3, "0", STR_PAD_LEFT);
              return  $gelombang->prefix.$counter;

              //return $gelombang->prefix.$kd;
          } catch (\Exception $e) {
              DB::rollback();
              return $e->getMessage();
              //    return false;

          }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
      $this->authorize('psb.index');
      $data=DB::table('psb')->where('uuid',$id)->where('daftar_ulang',false)->first();
      if (empty($data)) {
         toastr()->error('Error', '!!');;
         return redirect()->back();
      } else {
        // code...
      }
      $val=json_decode($data->data);
      $jurusan=DB::table('jurusan')->where('status',true)->get();
      $kurikulum=DB::table('kurikulum')->where('status',true)->get();
        return view('admin::psb.show',compact('data','jurusan','kurikulum','val'));
    }
    function storepsb(Request $request)
    {
      DB::beginTransaction();

          try {
              DB::commit();
            $password= rand(10000, 99999);
            $angkatan=DB::table('psb')->where('uuid', $request->uuid)->first();
            $jurusan=DB::table('jurusan')->where('uuid', $request->jurusan)->first();
            $total=DB::table('mahasiswa')->where('angkatan', $angkatan->gelombang)->count();
           $counter = str_pad($total+1, 3, "0", STR_PAD_LEFT);
            $nim= $angkatan->gelombang.$jurusan->kode.$counter;
            DB::table('users')->insert([
              'uuid'=>unik(),
              'name'=>$request->nama,
              'email'=>$request->email,
              'password'=>bcrypt($password),
              'old_password'=>$password,
              'status'=>true,
              'created_by'=>getadmin(),
              'created_at'=>Carbon::now()
            ]);
            $user=User::where('email',$request->email)->first();
            DB::table('mahasiswa')->insert([
              'uuid'=>unik(),
              'users_uuid'=>$user->uuid,
              'nim'=>$nim,
              'angkatan'=>$request->angkatan,
              'jurusan_uuid'=>$request->jurusan,
              'kurikulum_uuid'=>$request->kurikulum,
              'created_by'=>getadmin(),
              'created_at'=>Carbon::now()
            ]);
            DB::table('profile')->insert([
              'uuid'=>unik(),
              'users_uuid'=>$user->uuid,
              'nik'=>$request->nik,
              'nama_lengkap'=>$request->nama,
              'dob'=>$request->tgl_lahir,
              'sex'=>$request->sex,
              'religion'=>$request->agama,
              'merital_status'=>$request->merital_status,
              'blood_type'=>$request->blood_type,
              'address'=>$request->address,
              'province'=>$request->prov,
              'cities'=>$request->kab,
              'district'=>$request->kel,
              'villages'=>$request->kel,
              'tlp'=>$request->tlp,
              'avatar'=>null,
              'suit_size'=>$request->suit_size,
              'company_name'=>$request->company_name,
              'position'=>$request->position,
              'job_year'=>$request->job_year,
              'shifting'=>$request->shifting,
              'school_name'=>$request->school_name,
              'school_level'=>$request->level,
              'school_years'=>$request->start_year,
              'school_end_year'=>$request->end_year,
              'school_address'=>$request->school_address,
              'ijazah_no'=>$request->ijazah_no,
              'ayah'=>$request->ayah,
              'ibu'=>$request->ibu,
              'address_parent'=>$request->address_parent,
              'job'=>$request->job,
              'created_by'=>getadmin(),
              'created_at'=>Carbon::now()

            ]);
            DB::table('psb')->where('uuid',$request->uuid)->update(['daftar_ulang'=>true]);
            $user=User::where('email',$request->email)->first();

            $data=[
              'name'=>$request->nama,
              'email'=>$request->email,
              'old_password'=>$user->old_password
            ];
            $user->notify(new UserWelcome($data));

               toastr()->success('mahasiswa berhasil daftar', 'Sukses!');
               return redirect()->route('data.psb');
          } catch (\Exception $e) {
              DB::rollback();
            //  \Log::alert($e->getMessage()) ;
                  return $e->getMessage();
              //return redirect()->route('data.psb');
          }
    }
    function nim($no,$jurusan)
    {
      DB::beginTransaction();

          try {
              DB::commit();
              // all good
            $angkatan=DB::table('psb')->where('name', 'pattern');

          } catch (\Exception $e) {
              DB::rollback();
              return $e->getMessage();
                  return false;
              //return redirect()->back();
          }
    }
    function data_psb()
    {
      $this->authorize('data.psb');
      $data=DB::table('psb')->where('status',true)->where('daftar_ulang',false)->get();
      return view('admin::psb.dataPsb',compact('data'));
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
              DB::table('psb_gelombang')->where('uuid',$id)->update([
                'akademik_uuid'=>$request->akademik,
                'name'=>$request->nama,
                'prefix'=>$request->prefix,
                'status'=>$request->status,
                'updated_at'=>Carbon::now()
              ]);
              toastr()->success('Data diupdate', 'Sukses!');
              return redirect()->back();
          } catch (\Exception $e) {
              DB::rollback();
              return $e->getMessage();
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
