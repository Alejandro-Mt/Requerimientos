<?php

namespace App\Mail\Cliente;

use App\Models\solicitud;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SolicitudRequerimiento extends Mailable
{
    use Queueable, SerializesModels;

    public $dato;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($folio)
    {
        $this->dato = solicitud::where('folio',$folio)->first();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('correos.cliente.nuevasol');
    }
}
