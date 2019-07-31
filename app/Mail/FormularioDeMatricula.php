<?php

namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class FormularioDeMatricula extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct( $formulario )
    {
        $this->formulario = $formulario ;
        $nome = $formulario->nome;
        $this->subject('NOVA MATRÍCULA NO SITE - ' . $nome   );
    }

    public function build()
    {
        return $this->from('site@ibrasuperior.com.br')->view('formulario.mail')->with('formulario', $this->formulario );
    }
}
