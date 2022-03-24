<?php

namespace App\Mail;

use App\Models\registro;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SegundaValidacion extends Mailable
{
    use Queueable, SerializesModels;

    public $datos;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($folio)
    {
        //
        $this->datos = registro::where('folio',$folio)->get();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        foreach($this->datos as $validacion)
        if ($validacion->fechades == NULL) {
            return $this->markdown('correos.respuesta desarrollo.validar');
        } else {
            return $this->markdown('correos.respuesta desarrollo.novalidar');
        }
        #return dd($validacion->fechades);
    }
}
