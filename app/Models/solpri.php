<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class solpri extends Model
{
    use HasFactory; 
    protected $table = 'act_pri';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_cliente',
        'id_sistema',
        'orden',
        'solicitante',
        'id_user'
    ];
}
