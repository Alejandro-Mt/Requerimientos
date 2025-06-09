<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testing extends Model
{
    use HasFactory;
    protected $table = 'analisis';
    protected $primaryKey = 'folio';
    protected $fillable = [
        'folio',
        'fechaInicioC',
        'fechaFinC',
        'fechaInicioReal',
        'fechaFinReal'
    ];
}
