<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Invoice;
use App\Models\Commande;
use App\Models\AdresseLivraison;
use Kkiapay\Kkiapay;

class PayementController extends Controller
{
    public function commande_recue($id_com, $type_paiement) {

        $commande = Commande::findOrfail($id_com);
        $transaction_id = $_GET['transaction_id'] ?? null;

        $adr_livraison = AdresseLivraison::all();

        $route = view('site-public.commandes.commande-recue', compact('commande', 'type_paiement', 'adr_livraison'));

        if($commande->invoice->date_paid == null) {

            if($type_paiement == "livraison"){
                $commande->Update([
                    "status" => 'non payee',
                ]);
            }else{

                if($transaction_id && verify_kkiapay_transaction($transaction_id, $commande->invoice->id)) {
                    if(Invoice::where('reference', $transaction_id)->exists()){
                        flashy()->error('Ce paiement existe déjà');
                        return $route;
                    }

                    $commande->invoice->update([
                        'date_paid' => Carbon::now(),
                        'payment_method' => $type_paiement,
                        'reference' => $transaction_id,
                    ]);

                    $commande->update([
                        "status" => 'en cours',
                    ]);
                }
            }
        }

        return $route;
    }

    public function facture($id){
        $invoice = Invoice::findOrfail($id);
        $commande = Commande::where('invoice_id', $invoice->id)->first();
        $transaction_id = $_GET['transaction_id'] ?? null;
        $route = view('site-public.commandes.factures.facture', compact('invoice', 'commande'));

        if($invoice->date_paid == null) {
            if($transaction_id && verify_kkiapay_transaction($transaction_id, $invoice->id)) {
                if(Invoice::where('reference', $transaction_id)->exists()){
                    flashy()->error('Ce paiement existe déjà');
                    return $route;
                }

                $invoice->update([
                    'date_paid' => Carbon::now(),
                    'payment_method' => $_GET['type_paiement'],
                    'reference' => $transaction_id,
                ]);

                $commande->update([
                    "status" => 'en cours',
                ]);
            }
        }
        return $route;
    }
}
