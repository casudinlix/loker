<?php
use App\Traits\Uuid as Generator;
use Ramsey\Uuid\Uuid;
use Carbon\Carbon;


function getadmin()
{
  return Auth::user()->name;
}
function unik()
{
  return Uuid::uuid4()->toString();;
}
function tgl_indo($tgl){
        setlocale(LC_ALL, 'id');
        Carbon::setLocale('id');
       //return Carbon::parse($tgl)->formatLocalized('%A, %d %B %Y %H:%I:%S');
       return Carbon::parse($tgl)->formatLocalized('%A, %d %B %Y');
         // return $dt->formatLocalized('%A %d %B %Y  %H:%I:%S');
  }
function agama()
{
  return $data=['name'=>'Islam','name'=>'Kristen','name'=>'Hindu','name'=>'Budha','name'=>'Protestan','name'=>'Other'];
}
function hari()
{
return  $dt_hari = array(
  array('kd_hari' => '1','hari' => 'Senin','created_date' => NULL,'created_by' => NULL,'update_date' => NULL,'update_by' => NULL),
  array('kd_hari' => '2','hari' => 'Selasa','created_date' => NULL,'created_by' => NULL,'update_date' => NULL,'update_by' => NULL),
  array('kd_hari' => '3','hari' => 'Rabu','created_date' => NULL,'created_by' => NULL,'update_date' => NULL,'update_by' => NULL),
  array('kd_hari' => '4','hari' => 'Kamis','created_date' => NULL,'created_by' => NULL,'update_date' => NULL,'update_by' => NULL),
  array('kd_hari' => '5','hari' => 'Jumat','created_date' => NULL,'created_by' => NULL,'update_date' => NULL,'update_by' => NULL),
  array('kd_hari' => '6','hari' => 'Sabtu','created_date' => NULL,'created_by' => NULL,'update_date' => NULL,'update_by' => NULL),
  array('kd_hari' => '7','hari' => 'Minggu','created_date' => NULL,'created_by' => NULL,'update_date' => NULL,'update_by' => NULL),
  array('kd_hari' => '8','hari' => '-','created_date' => NULL,'created_by' => NULL,'update_date' => '2009-03-04 22:57:00','update_by' => NULL)
);

}
function akademik($uuid)
{
    $akademik=DB::table('akademik')->where('uuid',$uuid)->first();
    $now = Carbon::now();
  $start_date = Carbon::parse($akademik->start_date);

  $end_date = Carbon::parse($akademik->due_date);

  if($now->between($start_date,$end_date)){
    return 'ok';
  } else {
      return 'false';
  }
}
function krs()
{
  $krs=DB::table('krs_config')->where('akademik_uuid',tahunakademik())->first();
  $now = Carbon::now();
$start_date = Carbon::parse($krs->start_date);

$end_date = Carbon::parse($krs->due_date);

if($now->between($start_date,$end_date)){
  return 'ok';
} else {
    return 'false';
}
}
function krs_ijin($user)
{
    $d=DB::table('krs_ijin')->where('akademik_uuid',tahunakademik())->where('users_uuid',$user)->count();
if ($d>0) {
    $krs=DB::table('krs_ijin')->where('akademik_uuid',tahunakademik())->where('users_uuid',$user)->first();

    $now = Carbon::now();
  $start_date = Carbon::parse($krs->start_date);

  $end_date = Carbon::parse($krs->due_date);

  if($now->between($start_date,$end_date)){
    return 'ok';
  } else {
      return 'false';
  }
} else {
    return 'kosong';
}


}

function invoice($user)
{

return DB::table('invoice')->where('users_uuid',$user)->where('status','!=','Lunas')->count();

}
function tahunakademik()
{

  return $data=DB::table('akademik')->where('status', true)->first()->uuid;
}
function akademikname()
{

  return $data=DB::table('akademik')->where('status', true)->first()->name;
}
function nomor($table,$prefix)
{
  $data=DB::table($table)->max('id');
  $max_id = $data;
  if(isset($max_id) && $max_id > 0)
        {
          $max_id = $max_id+1;
        }else{
            $max_id = 1;
        }
        if(!$max_id){
        $max_id = '0000'.$max_id;
      }elseif($max_id > 0 && $max_id < 10){
          $max_id = '0000'.$max_id;
      }elseif($max_id >= 10 && $max_id < 100){
          $max_id = '000'.$max_id;
      }elseif($max_id >= 100 && $max_id < 1000){
          $max_id = '00'.$max_id;
      }elseif($max_id >= 1000 && $max_id < 10000){
          $max_id = '0'.$max_id;
      }else{
          $max_id = $max_id;
      }
      return $prefix.$max_id;



}
function avatar()
{
    return DB::table('profile')->where('users_uuid',Auth::user()->uuid)->first()->avatar;
}
function get_mhs()
{
    return Auth::user()->name;
}
function nim()
{
    return DB::table('mahasiswa')->where('users_uuid',Auth::user()->uuid)->first()->nim;

}
