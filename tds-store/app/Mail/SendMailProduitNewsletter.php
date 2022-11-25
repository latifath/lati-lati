<?php

namespace App\Mail;

use App\Models\Produit;
use App\Models\Newsletter;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMailProduitNewsletter extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Newsletter $newsletter, Produit $produit)
    {
        $this->newsletter = $newsletter;

        $this->produit = $produit;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('contact@tdsstore.bj')
                    ->subject('Nouveauté sur le site')
                    ->markdown('mails.send-mail-produit-newsletter')
                    ->with([
                        'produit' => $this->produit,
                        'newsletter' => $this->newsletter,
                    ]);
    }
}
