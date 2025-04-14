<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cronograma extends Model
{
    use HasFactory;
    protected $fillable = [
        'folio',
        'titulo',
        'inicio',
        'fin',
        'color',
    ];
}
