<?php

namespace App\Exports;

use App\Models\gatt;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class GanttExport implements FromCollection, WithHeadings
{
    protected $folio;

    /**
     * Crea una nueva instancia de la clase.
     *
     * @param string $folio
     */
    public function __construct($folio)
    {
        $this->folio = $folio;
    }

    /**
     * Obtiene la colección para exportar los datos.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $events = gatt::where('folio', $this->folio)->with('estatus')->get();
        $data = $events->map(function ($event) {
            return [
                'title' => $event->estatus->titulo,
                'start' => $event->fecha_inicio,
                'end'   => $event->fecha_fin,
                'dur'   => $event->CalcDias($event->fecha_inicio,$event->fecha_fin)
            ];
        });
        return $data;
    }

    /**
     * Define los encabezados de las columnas.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'Estatus',
            'Fecha Inicio',
            'Fecha Fin',
            'Duración'
        ];
    }
}
