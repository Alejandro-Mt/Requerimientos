<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class responsable extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_responsable';
    protected $fillable = [
        'nombre_r', 
        'apellidos', 
        'email', 
        'id_area'
    ];
}
