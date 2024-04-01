<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class solicitud extends Model
{
    use HasFactory;
    protected $table = 'solicitudes';
    protected $fillable = [
        'folio',
        'solicitante',
        'correo',
        'id_cliente',
        'id_sistema',
        'descripcion',
        'id_estatus',
        'planteamiento'
    ];

    public function sistema()
    {
        return $this->belongsTo(sistema::class, 'id_sistema', 'id_sistema');
    }

    public function titulo()
    {
        return "{$this->folio} {$this->descripcion}";
    }

    public function registro()
    {
        return $this->belongsTo(registro::class, 'folior', 'folio');
    }
}
