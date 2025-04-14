<?php

namespace App\Mail\Interno;

use Illuminate\Support\Facades\DB;
use App\Models\acceso;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FoliosAbiertos extends Mailable
{
    use Queueable, SerializesModels;

    public $registros;
    public $usuario;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($registros,$usuario)
    {
        //
        $this->registros = $registros;
        $this->usuario = $usuario;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('correos.interno.folios_abiertos');
    }
}
