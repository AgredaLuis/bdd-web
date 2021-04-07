<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RecuperarContrasena extends Mailable
{
    use Queueable, SerializesModels;

    public $DataMail=[];

    public $Subject='Contraseña Recuperada SIAEPUDO';

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($DataMail)
    {
        $this->DataMail = $DataMail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.usuario.recuperarcontrasena')->subject($this->Subject);
    }
}
