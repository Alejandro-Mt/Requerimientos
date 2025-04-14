<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class puesto extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_puesto';
    protected $fillable = [
        'puesto',
        'jerarquia'
    ];
}
