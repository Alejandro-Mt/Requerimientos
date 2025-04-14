<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TicketImport implements ToArray, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    /*public function array(array $rows)
    {
        $headers = $rows[0];
        unset($rows[0]);
        
        foreach ($rows as $row) {
          if (count($row) >= 1) {
            $rol        = Auth::user()->usrdata->rol->id_rol;
            $fecha      = Date::excelToDateTimeObject($row[0]);
            $nivel      = Estatus::where('id_estatus',$row[7])->first();
            //$nivel      = $nivel ? $nivel->nivel : 2;
            if($nivel) {$nivel->nivel = 2;}
            /*$invitado=Invitado::updateOrCreate(
                ['email'    => $row['4']],
                [
                  'nombre'  => strtoupper($row[0]),
                  'a_pat'   => strtoupper($row[1]),
                  'a_mat'   => strtoupper($row[2]),
                  'movil'   => $row[3]
                ]
            );-->
            
            $ticket = new Ticket([
                'fecha_reporte'     => $fecha,
                'id_cliente'        => $row[1],
                'id_localidad'      => $row[2],
                'id_sistema'        => $row[3],
                'id_so'             => $row[4],
                'id_incidencia'     => $row[5],
                'id_solicitante'    => $row[6],
                'nivel'             => $nivel->nivel,
                'id_estatus'        => $row[7],
                'id_cc'             => $row[8],
                'id_pip'            => $row[9]
            ]);
            $ticket->save();
            $comentario = new Comentario([
                'folio'     => $ticket->folio,
                'id_user'   => $row[9],
                'comentario'=> $row[10],
                'tipo'      => 'padre',
                'id_estatus'=> (int)$row[7],
            ]);
            $comentario->save();
          }
        }
    }*/

    public function mapping(): array
    {
      return [
        'fecha_soporte'       => 'A1',
        'hora'                => 'B1',
        'cliente'             => 'C1',
        'localidad'           => 'D1',
        'sistema'             => 'E1',
        'sop'                 => 'F1',
        'incidencia'          => 'G1',
        'solicitante'         => 'H1',
        'comentario'          => 'I1'
      ];
    }
    public function array(array $rows)
    {
        foreach ($rows as $row) {
          $ticketData = [
            'fecha_reporte' => $row['fecha_soporte'],
            'hora' => $row['hora'],
            'id_cliente' => $row['cliente'],
            'id_localidad' => $row['localidad'],
            'id_sistema' => $row['sistema'],
            'id_so' => $row['s_op'],
            'id_incidencia' => $row['incidencia'],
            'id_solicitante' => $row['solicitante'],
            'comentario' => $row['comentario'],
          ];
          $data[] = $ticketData;
          #dd($data);
        }
        #dd($data);

        return $data;
    }
}
