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


    public function payer_index(){
        return view('espace-client.commande.index_pour_paiement');
    }

    public function create(Request $request){
        $request->validate([

            'commande_id' => 'required',
            'date' => 'required',
            'type_paiement' => 'required',
            'montant' => 'required',
        ]);

        Paiement::create(['commande_id' => $request->commande_id, 'created_at' => $request->date, 'type_paiement' => $request->type_paiement, 'montant' => $request->montant,]);

        flashy()->info('Commande Payée avec succès.');

        return redirect()->back();
    }
}
