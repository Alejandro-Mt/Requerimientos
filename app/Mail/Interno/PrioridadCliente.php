<?php

namespace App\Mail\Interno;

use App\Models\cliente;
use App\Models\registro;
use App\Models\sistema;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class PrioridadCliente extends Mailable
{
    use Queueable, SerializesModels;

    public $cliente;
    public $orden;
    public $sistema;
    public $solicitante;
    public $usuario;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($autoriza)
    {
        //
        $this->solicitante = $autoriza->solicitante;
        $this->cliente = cliente::where('id_cliente',$autoriza->id_cliente)->first();
        $this->sistema = sistema::where('id_sistema',$autoriza->id_sistema)->first();
        $folios = explode(',', $autoriza->orden);
        $this->orden = registro::wherein('folio', $folios)->get();
        $this->usuario = Auth::user()->nombre.' '.Auth::user()->apaterno;
        
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
