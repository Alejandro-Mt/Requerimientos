<?php

namespace App\Mail\General;

use App\Models\mesa as ModelsMesa;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Mesa extends Mailable
{
    use Queueable, SerializesModels;

    public $mesa;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mesa)
    {
        $this->mesa = $mesa;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email = $this->markdown('correos.general.mesa')->attach(public_path($this->mesa->evidencia));
        return $email;
    }
}
