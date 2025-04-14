<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RequerimientosExport implements FromCollection, WithHeadings
{
    protected $result;

    public function __construct($result)
    {
        $this->result = $result;
    }

    public function collection()
    {
        return collect($this->result);
    }

    public function headings(): array
    {
        return [
            'ID',
            'SOLICITANTE',
            'Folio',
            'Titulo',
            'Tipo',
            'Estatus',
            'Clasificacion',
            'Sistema',
            'Responsable Arq',
            'Cliente',
            'Responsable PIP',
            'Impacto',
            'Fecha solicitud',
            'Fecha de levantamiento',
            '*Dias',
            'Fecha de autorizacion',
            'Dias para autorizar',
            'Fecha de definición de impacto',
            'Dias de respuesta',
            'Compromiso de def. de req.',
            'Entrega de def. de req.',
            'Dias de retraso',
            'Fecha de envio a cliente',
            'Dias para envio',
            'Fecha de autorizacion de def. de . req',
            'Fecha de entrega de plan de trabajo',
            'Fecha de contrucción',
            'Dias en construcción',
            'Fecha de compromiso par ambiente',
            'Fecha de liberación',
            'Dias de atraso',
            'Fecha de inicio pruebas en ambiente pre',
            'Dias en iniciar',
            'Fecha de fin pruebas en ambiente pre',
            'Dias en pruebas',
            'Fecha de implementación',
            'Duración del requerimiento en dias'
        ];

    }
}
