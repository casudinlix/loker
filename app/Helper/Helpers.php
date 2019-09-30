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
function allkurikulum($uuid)
{

}
