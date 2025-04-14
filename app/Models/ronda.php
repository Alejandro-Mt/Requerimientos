<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ronda extends Model
{
    use HasFactory;
    protected $fillable = [
        'folio',
        'evidencia',
        'aprobadas',
        'rechazadas',
        'ronda',
        'efectividad'
    ];
    
    public function dataRonda($folio)
    {
        return static::selectRaw('MAX(ronda) as ronda, SUM(aprobadas) as aprobadas, SUM(rechazadas) as rechazadas')
            ->where('folio', $folio)
            ->first();
    }
}
