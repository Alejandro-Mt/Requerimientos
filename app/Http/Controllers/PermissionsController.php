<?php

namespace App\Http\Controllers;

use App\Models\user;
use Illuminate\Http\Request;

class PermissionsController extends Controller
{
    //
    public function ajustes()
    {
        $equipo = user::all();
        return view('formatos.ajustes',compact('equipo'));
        #dd($pausa);
    }
}
