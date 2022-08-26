<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Commande;
use App\Models\Paiement;

class PaiementClientController extends Controller
{
    public function index(){

      $commandes = Commande::where('user_id', auth()->user()->id)->get();

        return view('espace-client.paiement.index', compact('commandes'));
    }


}
