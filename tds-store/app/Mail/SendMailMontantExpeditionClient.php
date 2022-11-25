<?php

namespace App\Mail;

use App\Models\Invoice;
use App\Models\InvoiceItem;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMailMontantExpeditionClient extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Invoice $invoice)
    {
        $this->invoice = $invoice;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('contact@tdsstore.bj')
        ->subject('Montant Expédition')
        ->markdown('mails.send-mail-montant-expedition-client')
        ->with(['invoice' => $this->invoice
    ]);
    }
}
