<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cliente extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_cliente';
    protected $fillable = [
        'nombre_cl',
        'abreviacion'
    ];
}
