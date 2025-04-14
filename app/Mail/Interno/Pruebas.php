<?php

namespace App\Mail\Interno;

use App\Models\registro;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Pruebas extends Mailable
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
        $this->datos = registro::where('folio',$folio)->first();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if($this->datos->estatus->posicion == 9){
<<<<<<< HEAD
            $subject = 'Fin de pruenas Testing';
        } else{
            $subject = 'Fin de pruenas PIP';
=======
            $subject = 'Fin de pruebas Testing';
        } else{
            $subject = 'Fin de pruebas PIP';
>>>>>>> versionprod
        }
        $email = $this->markdown('correos.interno.pruebas')->subject($subject);
        return $email;
    }
}
