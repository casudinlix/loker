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
    return true;
  } else {
      return false;
  }
}
function krs($uuid)
{
  $krs=DB::table('krs_config')->where('uuid',$uuid)->first();
  $now = Carbon::now();
$start_date = Carbon::parse($krs->start_date);

$end_date = Carbon::parse($krs->due_date);

if($now->between($start_date,$end_date)){
  return true;
} else {
    return false;
}
}

function tahunakademik()
{

  return $data=DB::table('akademik')->where('status', true);
}
