<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class levantamiento extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'folio';
    protected $fillable = [
        'folio',
        'solicitante',
        'departamento',
        #'jefe_departamento',
        'autorizacion',
        'previo',
        'problema',
        'prioridad',
        'general',
        'impacto',
        'detalle',
        'relaciones',
        'areas',
        'esperado',
        'involucrados',
        'estatusAut',
        'id_solicitante',
        'id_division'
    ];
}
