<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OlvidoContrasena extends Mailable
{
    use Queueable, SerializesModels;

    public $DataMail=[];

    public $Subject='Recuperar Contraseña SIAEPUDO';

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
        return $this->markdown('emails.usuario.olvidocontrasena')->subject($this->Subject);
    }
}