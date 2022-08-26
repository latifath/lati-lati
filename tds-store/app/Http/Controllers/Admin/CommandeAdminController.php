<?php

namespace App\Http\Controllers\Admin;

use App\Models\Produit;
use App\Models\Commande;
use App\Models\Paiement;
use App\Models\Newsletter;
use Illuminate\Http\Request;
use App\Models\AdresseClient;
use App\Models\CommandeProduit;
use App\Models\AdresseLivraison;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailCommandeAcceptee;
use App\Mail\SendMailCommandeAnnuleeClient;

class CommandeAdminController extends Controller
{
    public function index(){
        //  $commandes = Commande::all();

        // return view('espace-admin.commandes.index', compact('commandes'));

        $commandes_effectuee = Commande:: where('status', 'attente paiement')->get();

        $commandes_en_attente = Commande::where('status', 'en cours')->get();

        $commandes_annulee = Commande::where('status', 'annulee')->get();

        $commandes_non_payee = Commande::where('status', 'non payee')->get();

        $commandes_terminee = Commande::where('status', 'terminee')->get();

        return view('espace-admin.commandes.index', compact('commandes_effectuee', 'commandes_en_attente', 'commandes_annulee', 'commandes_non_payee', 'commandes_terminee'));

    }

    public function show($id){

        $commande = Commande::where('id', $id)->first();

       $adr_cli = AdresseClient::where('id', $commande->adresse_client_id)->first();

       $adr_livr = AdresseLivraison::where('id', $commande->adresse_livraison_id)->first();

        $commande_produit = CommandeProduit::where('commande_id', $id)->get();

        $paiement = Paiement::where('commande_id', $id)->get();

        return view('espace-admin.commandes.show', compact('adr_cli', 'commande', 'adr_livr', 'paiement', 'commande_produit'));
    }

    public function index_livraison(){
        $livraisons =AdresseLivraison::all();

        return view('espace-admin.commandes.index-livraison', compact('livraisons'));
    }

    public function valider_commande($id){

       $commande = Commande::findOrfail($id);

       $commande->update([

        'status' => 'terminee',

       ]);

       Mail::to($commande->adresse_client->email)->send(new SendMailCommandeAcceptee($commande));

       flashy()->success('commande validée avec succès');
        return redirect()->back();
    }

    public function annuler_commande($id){

        $commande = Commande::findOrfail($id);
        $produit_commandes = CommandeProduit::where('commande_id', $commande->id)->get();

        $commande->update([
            'status' => 'annulee',
        ]);

        foreach($produit_commandes as $produit_commande) {
            $produit = Produit::findOrfail($produit_commande->produit_id);
            $produit->quantite += $produit_commande->quantite;

            $produit->update([
                'quantite' => $produit->quantite,
            ]);

        }

        Mail::to($commande->adresse_client->email)->send(new SendMailCommandeAnnuleeClient($commande));

        flashy()->error('commande annuleée avec succès');
        return redirect()->back();
    }

    public function en_attente__commande($id){
        $cmde_attente  = Commande::find($id);
        $cmde_attente ['status'] = 'en cours';
        $cmde_attente ->save();

        flashy()->warning('commande mise en attente avec succès');
        return redirect()->back();
    }

    public function delete_commande(Request $request){

        $commande_s = Commande::findOrfail($request->id);

        $commande_s->delete();
        flashy()->error('Commande #'. $request->id . 'supprimée avec succès');
        return redirect()->route('root_espace_admin_commandes_index');
    }
}
