<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegistroUsuario extends Mailable
{
    use Queueable, SerializesModels;
    public $emailData;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->emailData = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('admin@gmail.com', 'Donanimal')
            ->subject('Notificación Prevención abandono animal')
            ->view('mails.user_create');
    }
}
