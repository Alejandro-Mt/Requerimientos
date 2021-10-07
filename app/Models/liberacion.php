<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class liberacion extends Model
{
    use HasFactory;
    protected $table = 'liberaciones';
    protected $fillable = [
        'folio',
        'fecha_lib_a',
        'fecha_lib_r',
        'inicio_lib',
        'inicio_p_r',
        't_pruebas',
        'evidencia_p'
    ];
}
