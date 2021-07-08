<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class registro extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'id_registro';
    protected $fillable = [
        'bitrix',
        'descripcion',
        'id_responsable',
        'id_sistema',
        'id_cliente',
        'estatus'
    ];
}
