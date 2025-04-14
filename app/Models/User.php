<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
        'apaterno',
        'amaterno',
        'email',
        'password',
        'id_puesto',
        'id_area',
        'avatar',
        'external_id',
        'theme',
        'sidebar',
        'fix_sidebar',
        'fix_head',
        'box',
        'logo_color',
        'nav_color',
        'sidebar_color'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getFullnameAttribute()
    {
<<<<<<< HEAD
      return "{$this->nombre} {$this->apaterno} {$this->amaterno}";
=======
        return mb_strtoupper("{$this->nombre} {$this->apaterno} {$this->amaterno}", 'UTF-8');
>>>>>>> versionprod
    }

    public function usrdata(){
        return $this->belongsTo(usr_data::class, 'id', 'id_user');
    }
<<<<<<< HEAD
=======

    public function scopeActivos($query)
    {
        return $query->whereHas('usrdata', function ($query) {
            $query->where('activo', 1);
        });
    }

>>>>>>> versionprod
}
