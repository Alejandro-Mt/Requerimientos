<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class acceso extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_user',
        'id_sistema'
    ];
    
    // Define la relación hasMany con el modelo User
    public function user(){
        return $this->hasMany(User::class, 'id', 'id_user');
    }
    
    // Define la relación hasMany con el modelo User
    public function usr_data(){
        return $this->hasMany(usr_data::class, 'id_user', 'id_user');
    }
}
