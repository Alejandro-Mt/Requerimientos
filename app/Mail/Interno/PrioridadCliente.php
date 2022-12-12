<?php

namespace App\Mail\Interno;

use App\Models\sistema;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class PrioridadCliente extends Mailable
{
    use Queueable, SerializesModels;

    public $usuario;
    public $sistema;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        //
        $this->sistema = sistema::where('id_sistema',$data['id_sistema'])->first();
        $this->usuario = Auth::user()->nombre.' '.Auth::user()->apellidos;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('correos.interno.prioridad_cliente');
    }
}
