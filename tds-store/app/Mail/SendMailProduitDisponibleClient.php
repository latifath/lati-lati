<?php

namespace App\Mail;

use App\Models\Produit;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use App\Models\CommandeProduit;
use App\Models\ProduitNonLivrer;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMailProduitDisponibleClient extends Mailable
{
    use Queueable, SerializesModels;
    public $produit_non_livre;
    public $produit;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(ProduitNonLivrer $produit_non_livre, Produit $produit)
    {
        $this->produit_non_livre = $produit_non_livre;
        $this->produit = $produit;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('lmonsia@technodatasolutions.bj')
        ->subject('Produit disponible')
        ->markdown('mails.send-mail-produit-disponible-client')
        ->with('produit_non_livre', 'produit', $this->produit_non_livre, $this->produit);

    }
}
