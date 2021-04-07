<?php

namespace App\Imports;

use App\User;
use Maatwebsite\Excel\Concerns\ToModel;

class UserImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {//dd($row[28]);

        $usuario= User::where('cedula','=',$row[3])->where('periodo','=',$row[28])->count();

        if($usuario == 0){

            if(isset($row[28])&&isset($row[29])&&isset($row[30])&&isset($row[31])){
                //dd($row[28]);
                return new User([
                'nombre'=>$row[2],
                'cedula'=>$row[3],
                'cargo'=>$row[4],
                'periodo'=>$row[28],
                ]);

            }


        }

        
        
    }
}
