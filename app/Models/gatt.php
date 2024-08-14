<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class gatt extends Model
{
    use HasFactory;
    protected $table = 'durxest';
    protected $fillable = [
        'folio',
        'id_estatus',
        'fecha_inicio',
        'fecha_fin',
        'color',
    ];
    public function estatus(){
        return $this->belongsTo(estatu::class, 'id_estatus', 'id_estatus');
    }
}
