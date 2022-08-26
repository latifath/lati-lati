<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Commande;
use App\Models\Paiement;
use Illuminate\Http\Request;
use App\Models\AdresseClient;
use App\Models\AdresseLivraison;
use App\Http\Controllers\Controller;

class PaiementAdminController extends Controller
{
    public function index(){
        $paiements = Paiement::all();

        $cmdes = Commande::all();

        return view('/espace-admin.paiements.index', compact('paiements', 'cmdes'));

    }

    public function show($id){
        $client = User::findOrfail($id);

        $commandes = Commande::where('user_id', $client->id)->get();

        return view('/espace-admin.paiements.index', compact('commandes'));
    }

    public function edit(Request $request){

        $request->validate([
            'montant' => 'required',
            'date' => 'required',
           'type_paiement' => 'required',
           'commande_id' => 'required',
        ]);

        // dd($request->type_paiement, $request->commande_id);

        Paiement::findOrfail($request->id)->update([

            "montant" => $request->montant,
            "created_at" => $request->date,
           "type_paiement" => $request->type_paiement,
            "commande_id" => $request->commande_id,

        ]);


        flashy()->success('Paiement #'. $request->id . 'modifiée avec succès');

        return redirect()->back();
    }

//    pour ajouter un paiement

    public function detail($id){

        $commande = Commande::where('id', $id)->first();

       $adr_cli = AdresseClient::where('id', $commande->adresse_client_id)->first();

       $adr_livr = AdresseLivraison::where('id', $commande->adresse_livraison_id)->first();

        $paiement = Paiement::where('commande_id', $commande->id)->first();



        return view('espace-admin.commandes.create-paiement', compact('commande', 'adr_cli', 'adr_livr', 'paiement'));
    }

    public function delete(Request $request){

        $paiement = Paiement::findOrfail($request->id);

        $paiement->delete();

        flashy()->error('Paiement #'. $request->id . 'supprimée avec succès');

        return redirect()->back();
    }

    public function create(Request $request)
    {
        $request->validate([

            'commande_id' => 'required',
            'date' => 'required',
            'type_paiement' => 'required',
            'montant' => 'required',
            'reference' => 'required',


        ]);

        Paiement::create(['commande_id' => $request->commande_id, 'created_at' => $request->date, 'type_paiement' => $request->type_paiement, 'montant' => $request->montant, 'reference' => $request-> reference]);

        flashy()->info('Paiement créée avec succès.');

        return redirect()->back();
    }

}
