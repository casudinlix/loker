<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Traits\Uuid;
class DosenModel extends Model
{
  use Notifiable,Uuid;
    protected $fillable = ['name','email','status'];
    protected $table='dosens';

}
