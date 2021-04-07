<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UsuarioConfirmado extends Mailable
{
    use Queueable, SerializesModels;

    public $Subject='Usuario Confirmado SIAEPUDO';

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.usuario.usuarioconfirmado')->subject($this->Subject);
    }
}
