<?php

namespace App\Imports;

use App\Recibo;
use Maatwebsite\Excel\Concerns\ToModel;

class ReciboImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        
            $Recibo = Recibo::where('cedula','=',$row[3])->where('periodo','=',$row[28])->count();

            if($Recibo == 0){

                if(isset($row[28])&&isset($row[29])&&isset($row[30])&&isset($row[31])){
                    //dd($row[5]);
                    return new Recibo([
                        'nombre'=>$row[2],
                        'cedula'=>$row[3],
                        'cargo'=>$row[4],
                        'ingreso'=>$row[5],
                        'salario_mensual'=>round($row[6],2),
                        'salario_quincenal'=>round($row[7],2),
                        'bono_nocturno'=>round($row[8],2),
                        'profesionalizacion'=>round($row[9],2),
                        'tiempo_antiguedad'=>$row[10],
                        'prima_antiguedad'=>round($row[11],2),
                        'hijos'=>$row[12],
                        'prima_hijos'=>round($row[13],2),
                        'dias_feriado'=>round($row[14],2),
                        'dias_descanso'=>round($row[15],2),
                        'hed'=>round($row[16],2),
                        'hen'=>round($row[17],2),
                        'otras_asignaciones'=>round($row[18],2),
                        'total_asignaciones'=>round($row[19],2),
                        'manutencion'=>round($row[20],2),
                        'dias_no_laborados'=>$row[21],
                        'descuento_sueldo'=>round($row[22],2),
                        'ivss'=>round($row[23],2),
                        'rpe'=>round($row[24],2),
                        'faov'=>round($row[25],2),
                        'total_deduccion'=>round($row[26],2),
                        'neto_pagar'=>round($row[27],2),
                        'periodo'=>$row[28],
                        'mes'=>$row[29],
                        'anio'=>$row[30],
                        'tipo'=>$row[31],
                        'tipo_trabajador'=>$row[32],
                    ]);

                }


            }
       
    }
}
