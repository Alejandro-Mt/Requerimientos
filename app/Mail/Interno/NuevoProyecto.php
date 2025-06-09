<?php

namespace App\Mail\Interno;

use App\Models\registro;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NuevoProyecto extends Mailable
{
    use Queueable, SerializesModels;

    public $dato;
    public $destinatario;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($registro,$nombre)
    {
        //
        
        $this->dato = $registro;
        $this->destinatario = $nombre;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('correos.interno.proyecto_n');
    }
}
