<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class solicitante extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_solicitante';
    protected $fillable = [
        'nombre',
        'a_pat',
        'a_mat',
        'email',
        #'direccion',
    ];
}
