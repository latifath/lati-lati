<?php

namespace App\Mail;

use App\Models\Produit;
use App\Models\CommandeProduit;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMailProduitInsuffisantClient extends Mailable
{
    use Queueable, SerializesModels;

    public $stock_session = [];
    public $cde_pdt;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($stock_session, CommandeProduit $cde_pdt)
    {
        $this->stock_session = $stock_session;
        $this->cde_pdt = $cde_pdt;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('lmonsia@technodatasolutions.bj')
                    ->subject('Quantité Insuffisante')
                    ->markdown('mails.send-mail-produit-insuffisant-client')
                    ->with([
                          'stock_session' => $this->stock_session,
                          'cde_pdt' => $this->cde_pdt,
                    ]);
    }
}
