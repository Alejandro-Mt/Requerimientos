<?php

namespace App\Mail\Interno;

use App\Models\cliente;
use App\Models\sistema;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ActualizacionPrioridades extends Mailable
{
    use Queueable, SerializesModels;

    public $cliente;
    public $solicitante;
    public $sistema;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        
            $this->solicitante = $data['solicitante'];
            $this->cliente = cliente::where('id_cliente',$data['id_cliente'])->get();
            $this->sistema = sistema::where('id_sistema',$data['id_sistema'])->get();
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('correos.interno.ajuste-prioridad');
    }
}