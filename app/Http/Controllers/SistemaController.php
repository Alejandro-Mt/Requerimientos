<?php

namespace App\Http\Controllers;

use App\Models\sistema;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SistemaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $data)
    {
        $rename = $data->nombre_s.'.'.pathinfo($data->file('logo')->getClientOriginalName(), PATHINFO_EXTENSION);
        /*$data->validate(['logo'=>'required']);{
            $file = Storage::putFileAs("public/sistemas", $data->file('logo'),$rename);
            $url = Storage::url($file);
        }*/
        sistema::create([
            'nombre_s' => $data['nombre_s'],
            'dispercion'=> $data['dispercion'],
            //'logo'=> $url
        ]);
        return redirect(route('Seguir'));
        #dd($url);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $data, $id_sistema)
    {
        $rename = $data->nombre_s.'.'.pathinfo($data->file('logo')->getClientOriginalName(), PATHINFO_EXTENSION);
        $file = Storage::putFileAs("public/sistemas", $data->file('logo'),$rename);
        $url = Storage::url($file);
        $update = sistema::FindOrFail($id_sistema);
        $update->nombre_s = $data['nombre_s'];
        $update->dispercion= $data['dispercion']; 
        $update->logo= $url;
        $update->save();  
        return redirect(route('Seguir'));
        #dd($rename);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_sistema)
    {
        $id_sistema = sistema::find($id_sistema);
        $id_sistema->delete();
        return redirect(route('Seguir'));
    }
}
