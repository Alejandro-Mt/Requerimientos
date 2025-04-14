<?php

namespace App\Mail;

use App\Models\archivo;
use App\Models\registro;
use App\Models\responsable;
use App\Models\sistema;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use PDF;

class ValidacionCliente extends Mailable
{
    use Queueable, SerializesModels;

    public $formato;
    public $responsables;
    public $sistemas;
    public $involucrados;
    public $relaciones;
    public $subject;
    public $file;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($folio)
    {
        //
        $this->formato = registro::where('folio',$folio)->first();
        $this->sistemas = sistema::all();
        $this->responsables = User::all();
        $this->relaciones = explode(',',$this->formato->levantamiento->relaciones);
        $this->involucrados = explode(',',$this->formato->levantamiento->involucrados);
        $this->subject = $this->formato->titulo();
        $this->file = archivo::where('folio',$folio)->get();
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email = $this->markdown('correos.contenido');
        // $archivosadjuntos es una matriz con rutas de archivos de archivos adjuntos
        foreach($this->file as $ruta){
            $email->attach(public_path($ruta->url));
        }
        return $email;
        #return $this->file;

        
    }
}
