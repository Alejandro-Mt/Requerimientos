<?php

namespace App\Mail\Interno;

use App\Models\registro;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class N_Flujo extends Mailable
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
        $this->datos = registro::where('folio',$folio)->first();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email = $this->markdown('correos.interno.Nuevo_flujo')->subject('Nuevo flujo');
        return $email;
    }
}
