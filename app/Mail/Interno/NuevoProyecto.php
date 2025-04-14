<?php

namespace App\Mail\Interno;

use App\Models\registro;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NuevoProyecto extends Mailable
{
    use Queueable, SerializesModels;

    public $titulo;
    public $destinatario;
    public $estatus;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data,$nombre)
    {
        //
        $this->estatus = $data['id_estatus'];
<<<<<<< HEAD
        if ($data['id_estatus'] == NULL){
=======
        if ($data['id_estatus']== 17){
>>>>>>> versionprod
            $this->titulo = $data['descripcion'];
        }else{
            $this->titulo = registro::select('descripcion')->where('folio', $data->folio)->first();
        }
        
        $this->destinatario = $nombre;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('correos.interno.proyecto_n');
    }
}
