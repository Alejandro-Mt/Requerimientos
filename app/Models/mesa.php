<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mesa extends Model
{
    use HasFactory;
    protected $fillable = [
        'fecha_mesa',
        'folio',
        'es_alcance',
        'evidencia',
        'participantes',
        'objetivo',
    ];
}
