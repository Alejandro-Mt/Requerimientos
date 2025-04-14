<?php

namespace App\Mail\Cliente;

use App\Models\registro;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Fase extends Mailable
{
    use Queueable, SerializesModels;

    public $datos;
    public $estatus;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($folio, $estatus)
    {
        //
        $this->datos = registro::where('folio',$folio)->first();
        $this->estatus = $estatus;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('correos.cliente.fase');
    }
}
