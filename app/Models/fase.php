<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class fase extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'activo',
        'posicion'
    ];

    public function estatus() {
        return $this->hasMany(estatu::class, 'id_fase');
    }

}
