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


}
