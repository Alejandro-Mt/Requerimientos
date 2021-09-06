<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pausa extends Model
{
    use HasFactory;
    protected $fillable = [
        'folio',
        'pausa'];
}
