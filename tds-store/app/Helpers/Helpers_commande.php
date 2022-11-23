<?php

use App\Models\Commande;
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


if(!function_exists('commande')){
    function commande($invoice_id){
        $commande = Commande::where('invoice_id', $invoice_id)->first();
        return $commande;

    }
}
