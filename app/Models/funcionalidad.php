<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class funcionalidad extends Model
{
    use HasFactory;
    protected $table = 'estatus_funcionalidad';
    protected $primaryKey = 'id_estatus';
    protected $fillable = ['titulo'];
}
