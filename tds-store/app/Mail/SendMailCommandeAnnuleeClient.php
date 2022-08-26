<?php

namespace App\Mail;

use App\Models\Commande;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMailCommandeAnnuleeClient extends Mailable
{
    use Queueable, SerializesModels;
    public $commande;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Commande $commande)
    {
        $this->commande = $commande;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('lmonsia@technodatasolutions.bj')
        ->subject('Commande Annulée')
        ->markdown('mails.send-mail-commande-annulee-client')
        ->with(['commande' => $this->commande]);
    }
}
