<?php

namespace App\Http\Controllers;

use App\Models\configuracion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConfiguracionController extends Controller
{
    //
    public function index($id){
        $config = configuracion::where('id',Auth::user()->id)->first();
        return view('resources\views\layouts\rightbar.blade.php', compact('config'));
      }

}
