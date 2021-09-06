<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class construccion extends Model
{
    use HasFactory;
    protected $table = 'construccion';
    protected $fillable = [
        'folio',
        'fechaCompReqC',
        'evidencia',
        'fechaCompReqR',
        'desfase',
        'motivodesfase',
        'motivopausa',
        'evpausa',
        'fechareact'
    ];
}
