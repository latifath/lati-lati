<?php

namespace App\Mail;

use App\Models\Commande;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMailCommandeAcceptee extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Commande $cmde)
    {
        $this->cmde = $cmde;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('contact@tdsstore.bj')
                    ->subject('Confirmation Commande')
                    ->markdown('mails.send-mail-commande-acceptee')
                    ->with(['cmde' => $this->cmde]);
    }
}
