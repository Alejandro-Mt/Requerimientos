<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class usr_data extends Model
{
    use HasFactory;

    protected $table = 'usr_data';
    protected $primaryKey = 'id_usr_data';
    protected $fillable = [
        'id_user',
        'id_rol',
        'id_puesto',
        'id_area',
        'id_departamento',
        'id_division',
        'avatar',
        'activo',
        'external_id',
        'remember_token',
        'token_google',
        'id_sc'
    ];

    // Define la relación belongsTo con el modelo Rol
    public function area()
    {
        return $this->belongsTo(area::class, 'id_area', 'id_area');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    // Define la relación belongsTo con el modelo Departamento
    public function departamento()
    {
        return $this->belongsTo(departamento::class, 'id_departamento', 'id');
    }

    // Define la relación belongsTo con el modelo Division
    public function division()
    {
        return $this->belongsTo(division::class, 'id_division', 'id_division');
    }
    
    // Define la relación hasMany con el modelo AccesoSistema
    public function accesosis(){
        return $this->hasMany(acceso::class, 'id_user', 'id_user');
    }

    // Define la relación belongsTo con el modelo Puesto
    public function puesto()
    {
        return $this->belongsTo(puesto::class, 'id_puesto', 'id_puesto');
    }

    // En el modelo Usr_data
    public function usuariosdep()
    {
        return $this->hasMany(Usr_data::class, 'id_departamento', 'id_departamento');
    }

}
