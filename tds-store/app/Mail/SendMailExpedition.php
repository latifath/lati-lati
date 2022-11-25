<?php

namespace App\Mail;

use App\Models\Commande;
use App\Models\Livraison;
use App\Models\AdresseClient;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use App\Models\AdresseLivraison;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMailExpedition extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Livraison $livraison, AdresseClient $clt, AdresseLivraison $adresseLivraison, Commande $commande)
    {
        $this->livraison = $livraison;
        $this->clt = $clt;
        $this->adresseLivraison = $adresseLivraison;
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
        ->subject('Montant expédition à Communiquer')
        ->markdown('mails.send-mail-expedition-admin')
        ->with(['livraison' => $this->livraison, 'clt' => $this->clt, 'adresseLivraison' => $this->adresseLivraison, 'commande' => $this->commande]);
    }
}
