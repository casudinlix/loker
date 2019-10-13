<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class BiayaModel extends Model
{
      use Uuid;
     protected $guarded = []; //TAMBAHKAN LINE INI
     protected $table='biaya';
     protected $fillable=['name','type','created_by'];
     
}
