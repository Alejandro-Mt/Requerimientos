<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class gatt extends Model
{
    use HasFactory;
    protected $table = 'durxest';
    protected $fillable = [
        'folio',
        'id_estatus',
        'fecha_inicio',
        'fecha_fin',
        'color',
    ];
    public function estatus(){
        return $this->belongsTo(estatu::class, 'id_estatus', 'id_estatus');
    }

    public function CalcDias($fechainicio, $fechafin)
    {
        $resultado = DB::select("SELECT CalcDias(?, ?) AS resultado", [$fechainicio, $fechafin]);

        // El resultado es un array de objetos stdClass, así que extraemos el valor de la columna "resultado"
        $resultadoCalculado = $resultado[0]->resultado;

        return $resultadoCalculado;
    }
}
