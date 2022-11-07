<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SolicitudCurso extends Mailable
{
    use Queueable, SerializesModels;
    public $distressCall;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($dis)
    {
        //
        $this->distressCall=$dis;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('operaciones.confirmaciones.mails.curso_status');
    }
}
