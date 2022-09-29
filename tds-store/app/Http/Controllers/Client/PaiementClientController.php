<?php

namespace App\Http\Controllers\Client;

use App\Models\Commande;
use App\Models\Paiement;
use Illuminate\Http\Client\Request;
use App\Http\Controllers\Controller;

class PaiementClientController extends Controller
{
    public function index(){

      $commandes = Commande::where('user_id', auth()->user()->id)->get();

        return view('espace-client.paiement.index', compact('commandes'));
    }

    public function store($id_com, $type_paiement){
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
        return view('espace-client.validation-paiement', compact('pay', 'commande', 'type_paiement'));
    }

}
