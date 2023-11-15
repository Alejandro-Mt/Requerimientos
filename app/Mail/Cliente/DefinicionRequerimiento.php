<?php

namespace App\Mail\Cliente;

use App\Models\archivo;
use App\Models\registro;
use App\Models\solicitud;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DefinicionRequerimiento extends Mailable
{
    use Queueable, SerializesModels;
    public $datos;
    public $destinatario;
    public $archivos;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($folio)
    {
        //
        $this->datos = registro::where('folio',$folio)->first();
        $this->destinatario = solicitud::where('folior',$folio)->first();
        $this->archivos = archivo::where('folio', $folio)->
            where('url', 'LIKE', '%Definición de requerimiento%')->
            where('url', 'NOT LIKE', '%versión%')->
            first();

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email = $this->markdown('correos.cliente.definision')->subject('Definición de requerimineto');
            $email->attach(public_path().$this->archivos->url);

        return $email;
    }
}
