<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EnviarEmailsMailable extends Mailable
{
    use Queueable, SerializesModels;
    public $subject= "Soporte Nuevo";

    public $contacto;//="esta es la informacion de contancto"
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($contacto)
    {
        $this->contacto = $contacto;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //$datanueva=$this->contacto;
        return $this->subject('NUEVO SOPORTE')
                ->view('soporte.emailsoporte')
                ->from('tesisgeocompra2021@gmail.com','Tesis Geocompra')
                ->attach($this->contacto['imagen1']->getRealPath(),[
                         'as' =>$this->contacto['imagen1']->getClientOriginalName()
        ])  ->attach($this->contacto['imagen2']->getRealPath(),[
                         'as' =>$this->contacto['imagen2']->getClientOriginalName()
        ])  ->attach($this->contacto['imagen3']->getRealPath(),[
                         'as' =>$this->contacto['imagen3']->getClientOriginalName()
        ]);
    }
}
