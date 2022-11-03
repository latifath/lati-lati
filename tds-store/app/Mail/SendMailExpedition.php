<?php

namespace App\Mail;

use App\Models\AdresseClient;
use App\Models\Livraison;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
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
    public function __construct(Livraison $livraison, AdresseClient $clt)
    {
        $this->livraison = $livraison;
        $this->clt = $clt;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('lmonsia@technodatasolutions.bj')
        ->subject('Montant expédition à Communiquer')
        ->markdown('mails.send-mail-expedition-admin')
        ->with(['livraison' => $this->livraison, 'clt' => $this->clt]);
    }
}
