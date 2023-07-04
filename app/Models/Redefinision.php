<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Redefinision extends Model
{
    use HasFactory;
    protected $table = 'redefinision';
    protected $fillable = [
        'folio',
        'motivo',
        'definision',
        'analisis',
        'construccion',
    ];
}
