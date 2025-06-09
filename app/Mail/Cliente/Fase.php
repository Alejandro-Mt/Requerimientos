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
    public $fase;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($folio, $estatus)
    {
        //
        $this->datos = registro::where('folio',$folio)->first();
        #$this->estatus = $estatus;
        switch ($estatus) {
        case '7':
            $this->fase = ['nombre' => 'CONSTRUCCIÓN', 'icono' => 'icon_doc'];
            break;
        case '8':
            $this->fase = ['nombre' => 'LIBERACIÓN', 'icono' => 'icon_doc'];
            break;
        case '2':
            $this->fase = ['nombre' => 'IMPLEMENTACIÓN', 'icono' => 'icon_doc'];
            break;
        case '18':
            $this->fase = ['nombre' => 'IMPLEMENTADO', 'icono' => 'icon_doc'];
            break;
        case '14':
            $this->fase = ['nombre' => 'CANCELADO', 'icono' => 'icon_doc'];
            break;
        case 'POSPUESTO':
            $this->fase = ['nombre' => 'POSPUESTO', 'icono' => 'icon_doc'];
            break;
        case 'REANUDAR':
            $this->fase = ['nombre' => 'REACTIVADO', 'icono' => 'icon_doc'];
            break;
        default:
            $this->fase = ['nombre' => 'DESCONOCIDO', 'icono' => 'icon_doc'];
            break;
    }


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
