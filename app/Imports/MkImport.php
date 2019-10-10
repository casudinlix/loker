<?php

namespace App\Imports;

use App\Models\MkModel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\FromCollection;

class MkImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new MkModel([

            'kode'=>$row[0],
            'name'=>$row[1],
            'created_by'=>$row[2],

        ]);
    }
    public function collection()
    {
        return MkModel::all();
    }
}
