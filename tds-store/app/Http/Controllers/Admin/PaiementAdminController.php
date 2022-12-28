<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Invoice;
use App\Models\Commande;
use Illuminate\Http\Request;
use App\Models\AdresseClient;
use App\Models\AdresseLivraison;
use App\Http\Controllers\Controller;

class PaiementAdminController extends Controller
{
    public function index(){
        $bills = Invoice::all();

        $cmdes = Commande::all();

        return view('/espace-admin.paiements.index', compact('bills', 'cmdes'));

    }

    public function show($id){
        $client = User::findOrfail($id);

        $commandes = Commande::where('user_id', $client->id)->get();

        return view('/espace-admin.paiements.index', compact('commandes'));
    }

//    pour ajouter un paiement

    public function detail($id){

        $commande = Commande::where('id', $id)->first();

       $adr_cli = AdresseClient::where('id', $commande->adresse_client_id)->first();

       $adr_livr = AdresseLivraison::where('id', $commande->adresse_livraison_id)->first();

        return view('espace-admin.commandes.create-paiement', compact('commande', 'adr_cli', 'adr_livr'));
    }

    public function delete(Request $request){

        $invoice = Invoice::findOrfail($request->id);

        $invoice->delete();

        flashy()->error('Facture #'. $request->id . 'supprimée avec succès');

        return redirect()->back();
    }

    public function create(Request $request)
    {
        $request->validate([
            'date' => 'required',
            'type_paiement' => 'required',
            'montant' => 'required|numeric|min:'. $request->f_montant,
            'reference' => 'required|unique:invoices,reference,except,id',

        ]);

        $invoice = Invoice::findOrfail($request->id)->update([
            'date_paid' => $request->date,
            'payment_method' => $request->type_paiement,
            'total' => $request->montant,
            'reference' => $request->reference
        ]);

        $commande = Commande::where('invoice_id', $request->id)->first();

        Commande::findOrfail($commande->id)->update([
            'status' => "en cours",
        ]);

        flashy()->info('Paiement créée avec succès.');

        return redirect()->back();
    }

    public function facture_commande($id){
        $invoice = Invoice::findOrfail($id);
        $commande = Commande::where('invoice_id', $invoice->id)->first();
        $transaction_id = $_GET['transaction_id'] ?? null;
        $adresseclient =  $commande ? adresseclient($commande->adresse_client_id) : client($invoice->user_id);
        $items = $commande ? detail_commande($commande->id) : invoice_items($invoice->id);

        $route = view('site-public.commandes.factures.facture', compact('invoice', 'commande', 'adresseclient', 'items'));

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

                if ($commande) {
                    $commande->update([
                        "status" => 'en cours',
                    ]);
                }
            }
        }
        return $route;
    }
}
