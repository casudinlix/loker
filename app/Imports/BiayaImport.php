<?php

namespace App\Imports;

use App\Models\BiayaModel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow; //TAMBAHKAN CODE INI

class BiayaImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new BiayaModel([
            'name'=>$row['nama_biaya'],
            'type'=>$row['type'],
            'created_by'=>getadmin()
        ]);
    }
}
