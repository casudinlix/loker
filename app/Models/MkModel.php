<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class MkModel extends Model
{
  use Uuid;
  protected $guarded = [];
  protected $table='mk';
  protected $fillable=['kode','name'];

}
