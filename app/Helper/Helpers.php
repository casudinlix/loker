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
