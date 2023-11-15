<?php

namespace App\Mail\interno;

use App\Models\archivo;
use App\Models\registro;
use App\Models\solicitud;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class notificacion_definicion extends Mailable
{
    use Queueable, SerializesModels;
    public $datos;
    public $destinatario;
    public $file;

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
        $this->file = archivo::where('folio',$folio)->
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
        $email = $this->markdown('correos.interno.definicion')->subject('Definición de requerimineto PIP');
        $email->attach(public_path().$this->file->url);
        return $email;
    }
}
