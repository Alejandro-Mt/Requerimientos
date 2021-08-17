<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class planeacion extends Model
{
    use HasFactory;

    protected $table = 'planeacion';
    protected $fillable = [
        'folio',
        'fechaCompReqC',
        'evidencia',
        'fechaCompReqR',
        'desface',
        'motivodesface',
        'motivopausa',
        'evpausa',
        'fechareact'
    ];
}
