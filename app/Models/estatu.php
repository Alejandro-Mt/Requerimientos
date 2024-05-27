<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class estatu extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_estatus';
    protected $fillable = [
        'titulo',
        'activo',
        'posicion',
        'id_fase'
    ];
    
    public function fase()
    {
        return $this->belongsTo(fase::class, 'id_fase', 'id_fase');
    }
}
