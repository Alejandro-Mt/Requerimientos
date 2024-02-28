<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class estatu extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_estatus';
    
    public function fase()
    {
        return $this->belongsTo(fase::class, 'id_fase', 'id_fase');
    }
}
