<?php

namespace App\Http\Controllers\Client;


use App\Models\Client;
use App\Models\Commande;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeClientController extends Controller
{
    public function index(){

         $nb_cmd_effectuee = 0 ;
         $nb_cmd_attente = 0;
         $nb_cmd_annulee = 0;
         $nb_cmd_non_payee = 0;
         $nb_cmd_attente_paiement = 0;

        $commandes_effectuee = Commande:: where('user_id', auth()->user()->id)->where('status', 'terminee')->get();

        $commandes_en_attente = Commande:: where('user_id', auth()->user()->id)->where('status', 'en cours')->get();

        $commandes_annulee = Commande:: where('user_id', auth()->user()->id)->where('status', 'annulee')->get();

        $commandes_attente_paiement = Commande:: where('user_id', auth()->user()->id)->where('status', 'attente paiement')->get();

        $commandes_non_payee = Commande:: where('user_id', auth()->user()->id)->where('status', 'non payee')->get();


        $nb_cmd_effectuee = $nb_cmd_effectuee + $commandes_effectuee->count();

        $nb_cmd_attente = $nb_cmd_attente + $commandes_en_attente->count();

        $nb_cmd_annulee = $nb_cmd_annulee + $commandes_annulee->count();

        $nb_cmd_non_payee = $nb_cmd_non_payee + $commandes_non_payee->count();

        $nb_cmd_attente_paiement = $nb_cmd_attente_paiement + $commandes_attente_paiement->count();


       $commande = Commande:: where('user_id', auth()->user()->id)->where('status', 'en cours')->orwhere('status', 'terminee')->latest()->first();

        return view('espace-client.index', compact('nb_cmd_effectuee', 'nb_cmd_attente', 'nb_cmd_annulee', 'nb_cmd_non_payee', 'commande', 'nb_cmd_attente_paiement'));

    }

}
