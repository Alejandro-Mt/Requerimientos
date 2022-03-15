<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class registro extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'id_registro';
    protected $fillable = [
        'folio',
        'descripcion',
        'id_responsable',
        'id_sistema',
        'id_cliente',
        'id_estatus',
        'id_area',
        'id_arquitecto',
        'id_clase'
    ];
}
