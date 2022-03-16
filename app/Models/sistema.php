<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sistema extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_sistema';
    protected $fillable = [
        'nombre_s', 
        'dispercion',
    ];
    
}
