<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class subproceso extends Model
{
    use HasFactory;
    protected $fillable = [
        'folio',
        'subproceso',
        'estatus',
        'previsto',
        'estatus'
    ];
}
