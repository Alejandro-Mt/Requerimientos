<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class configuracion extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'theme',
        'sidebar',
        'fix_sidebar',
        'fix_head',
        'box',
        'logo_color',
        'nav_color',
        'sidebar_color'
    ];
}
