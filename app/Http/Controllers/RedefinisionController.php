<?php

namespace App\Http\Controllers;

use App\Models\Redefinision;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class RedefinisionController extends Controller
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
    public function create(Request $data,$folio)
    {
        if ($data['construccion'] == NULL) $data['construccion']; else $data['construccion'] = date('y/m/d', strtotime($data['construccion']));
        Redefinision::create([
            'folio' => $folio,
            'motivo' => $data['motivo'],
            'definision' => date('y/m/d', strtotime($data['definision'])),
            'analisis' => date('y/m/d', strtotime($data['analisis'])),
            'construccion' => $data['construccion']
        ]);
        return redirect(route('Documentos',Crypt::encrypt($folio)));
        #dd($data);
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
    public function edit(Request $data)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $data, $id_puesto)
    {
        #dd($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_puesto)
    {
        #dd($id_estatus);
    }
}
