<?php

namespace App\Mail;

use App\Models\Commande;
use App\Models\AdresseClient;
use App\Models\AdresseLivraison;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMailNewCommandeAdmin extends Mailable
{
    use Queueable, SerializesModels;
    public $clt;
    public $commande;
    public $adr;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(AdresseClient $clt, Commande $commande, AdresseLivraison $adr)
    {
        $this->clt = $clt;
        $this->commande = $commande;
        $this->adr = $adr;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('contact@tdsstore.bj')
        ->subject('Commande passée')
        ->markdown('mails.send-mail-new-commande-admin')
        ->with('clt', 'commande', 'adr',  $this->clt, $this->commande, $this->adr);
    }
}
