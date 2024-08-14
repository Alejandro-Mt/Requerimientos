<?php

namespace App\Mail\Interno;

use App\Models\registro;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Aut_f extends Mailable
{
    use Queueable, SerializesModels;
    public $datos;
    public $respuesta;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($folio,$respuesta)
    {
        //
        $this->datos        = registro::where('folio',$folio)->first();
        $this->respuesta    = $respuesta;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email = $this->markdown('correos.respuesta desarrollo.Aut_flujo')->subject('Flujo de trabajo');
        return $email;
    }
}
