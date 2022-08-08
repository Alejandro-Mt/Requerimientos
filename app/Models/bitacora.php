<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bitacora extends Model
{
    use HasFactory;
    protected $table = 'bitacora';
    protected $fillable = [
        'id_user',
        'usuario',
        'id_estatus',
        'campo'
    ];
}
