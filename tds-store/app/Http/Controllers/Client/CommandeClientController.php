<?php

namespace App\Http\Controllers\Client;

use App\Models\Commande;
use App\Models\Paiement;
use App\Models\CommandeProduit;
use App\Http\Controllers\Controller;

class CommandeClientController extends Controller
{
        public function index(){

            $list_commandes_effectuee = Commande:: where('user_id', auth()->user()->id)->where('status', 'terminee')->get();

            $list_commandes_en_attente = Commande:: where('user_id', auth()->user()->id)->where('status', 'en cours')->get();

            $list_commandes_annulee = Commande:: where('user_id', auth()->user()->id)->where('status', 'annulee')->get();

            $list_commandes_non_payee = Commande:: where('user_id', auth()->user()->id)->where('status', 'non payee')->get();

            $list_commandes_attente_paiement = Commande:: where('user_id', auth()->user()->id)->where('status', 'attente paiement')->get();


            return view('espace-client.commande.index', compact( 'list_commandes_effectuee', 'list_commandes_en_attente', 'list_commandes_annulee', 'list_commandes_non_payee', 'list_commandes_attente_paiement'));
        }

        public function show($id){
            $commande_detail = CommandeProduit:: where('commande_id', $id)->get();

            $commande = Commande::findOrfail($id);

            $paiement = Paiement::where('commande_id', $id)->first();

            return view('espace-client.commande.show', compact('commande_detail', 'id', 'commande', 'paiement'));
        }


        // Facture

        public function facture($id){

            $cmde = Commande::where('id', $id)->first();

            $pay = Paiement::where('commande_id', $cmde->id)->first();

            return view('espace-client.facture', compact('cmde', 'pay'));
        }
}
