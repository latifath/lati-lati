<?php

use App\Models\Commande;
use App\Models\Paiement;
use App\Models\CommandeProduit;


// pour faire appel au montant total vu qu'elle apparait sur plusieurs pages
if(!function_exists('total_commande')){
    function total_commande($id){
        $total = 0;
        $compdt = CommandeProduit::where('commande_id', $id)->get();

        foreach ($compdt as $key => $value) {
            $total = $total + $value->prix * $value->quantite ;
        }
        return $total;
    }
}
// end

if(!function_exists('detail_commande')) {
    function detail_commande($id){
        $commande_produit = CommandeProduit:: where('commande_id', $id)->get();
        return $commande_produit;
    }
}


if(!function_exists('account_commande')) {
    function account_commande($id){
        $account = Paiement::where('commande_id', $id)->first();
        return $account;
    }
}

if(!function_exists('compte_com')){
    function compte_com($id){
        $com = Paiement::findOrfail($id);
        return $com;
    }
}

if(!function_exists('commande')){
    function commande($id){
        $commande = Commande::where('id', $id)->first();
        return $commande;

    }
}

if(!function_exists('exist_commande_paiement')) {
    function exist_commande_paiement($id){
        return Paiement::where('commande_id', $id)->first();
    }
}
