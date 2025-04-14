<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
    
    public function autorizador()
    {
        return $this->belongsTo(User::class, 'autorizacion', 'id');
    }

    public function depto()
    {
        return $this->belongsTo(departamento::class, 'departamento', 'id');
    }

    public function involucrados($folio)
    {
        return $this->where('folio', $folio)
        ->leftJoin('users AS u', function ($join) {
                $join->on(DB::raw('FIND_IN_SET(u.id, levantamientos.involucrados)'), '>', DB::raw('0'));
            })
        ->get();
    }

    public function sol()
    {
        return $this->belongsTo(User::class, 'id_solicitante', 'id');
    }
}
