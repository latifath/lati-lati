<?php

namespace App\Mail;

use App\Models\Commande;
use App\Models\AdresseClient;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use App\Models\CommandeProduit;
use App\Models\AdresseLivraison;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMailNewCommandeClient extends Mailable
{
    use Queueable, SerializesModels;
    public  $clt, $adr, $commande;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(AdresseClient $clt , Commande $commande, AdresseLivraison $adr)
    {
        $this->clt = $clt;
        $this->adr = $adr;
        $this->commande = $commande;
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
                    ->markdown('mails.send-mail-new-commande-client')
                    ->with('clt', 'commande', 'adr', $this->clt, $this->commande, $this->adr);

    }
}
