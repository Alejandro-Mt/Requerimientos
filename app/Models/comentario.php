<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comentario extends Model
{
    use HasFactory;
    protected $fillable = [
        'folio',
        'usuario',
        'contenido',
        'respuesta',
        'id_estatus'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'usuario', 'id');
    }
    
}
