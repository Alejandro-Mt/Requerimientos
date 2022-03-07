<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class archivo extends Model
{
    use HasFactory;
    protected $fillable = [
        'folio',
        'url',
    ];
}
