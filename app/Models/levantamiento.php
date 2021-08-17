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
        'jefe_departamento',
        'autorizacion',
        'previo',
        'problema',
        'impacto',
        'general',
        'detalle',
        'relaciones',
        'esperado',
        'involucrados'
    ];
}
