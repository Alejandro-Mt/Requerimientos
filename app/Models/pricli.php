<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pricli extends Model
{
    use HasFactory;
    protected $table = 'pri_cli';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_sistema',
        'orden',
        'id_user'
    ];
}
