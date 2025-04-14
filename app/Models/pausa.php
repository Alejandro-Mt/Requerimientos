<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pausa extends Model
{
    use HasFactory;
    protected $fillable = [
        'folio',
        'pausa',
        'id_motivo',
        'id_estatus'
    ];

    public function estatus()
    {
        return $this->belongsTo(estatu::class, 'id_estatus', 'id_estatus');
    }

    public function desfase()
    {
        return $this->belongsTo(desfase::class, 'id_motivo', 'id');
    }

}
