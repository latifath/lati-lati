<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Paiement;
use App\Models\AdresseLivraison;

class PayementController extends Controller
{
    public function commande_recue($id_com, $type_paiement) {

        $commande = Commande::findOrfail($id_com);
        $pay = "";

        $commande_exist = Paiement::where('commande_id', $id_com)->first();
        if($commande_exist == null) {

            if($type_paiement == "livraison"){
                $commande->Update([
                    "status" => 'non payee',
                ]);
            }else{
                $pay = Paiement:: create([
                        'commande_id' => $commande->id,
                        'reference' => $_GET ['transaction_id'],
                        'montant'  => kkiapay($_GET ['transaction_id'])->amount,
                        'type_paiement' => $type_paiement,
                    ]);
                $commande->Update([
                    "status" => 'en cours',
                ]);
            }
        }
        else{
            $pay = $commande_exist;
        }

        $adr_livraison = AdresseLivraison::all();

        return view('site-public.commandes.commande-recue', compact('commande', 'type_paiement', 'adr_livraison', 'pay'));
    }

    public function facture($id, $type_paiement){
        $cmde = Commande::where('id', $id)->first();
        $pay = Paiement::where('commande_id', $cmde->id)->first();

        return view('site-public.commandes.factures.facture', compact('cmde', 'type_paiement', 'pay'));
    }
}
