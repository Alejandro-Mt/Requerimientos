<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class implementacion extends Model
{
    use HasFactory;
    
    protected $table = 'implementaciones';
    protected $fillable = [
        'folio',
        'cronograma',
        'link_c',
        'f_implementacion',
        'estatus_f',
        'seguimiento',
        'comentarios'
    ];
}
