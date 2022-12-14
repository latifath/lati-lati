<?php

namespace App\Http\Controllers\Admin;

use App\Models\Produit;
use Illuminate\Http\Request;
use App\Models\CommandeProduit;
use App\Models\ProduitNonLivrer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailProduitDisponibleClient;

class ProduitNonLivrerAdminContoller extends Controller
{
    public function index(){
        $produits_non_livre = ProduitNonLivrer::where('status', 'non livré')->get();

        $produits_livre = ProduitNonLivrer::where('status', 'livré')->get();

        return view('espace-admin.produits.produit-non-livre.produit-non-livre', compact('produits_non_livre', 'produits_livre'));
    }

    public function validation_produit_livre(Request $request, $id){

        $produit_non_livre =  ProduitNonLivrer::findOrfail($request->id);

        $produit = Produit::findOrfail($produit_non_livre->produit_id);

        if($produit->quantite >= $produit_non_livre->quantite){

            $produit->quantite = $produit->quantite - $produit_non_livre->quantite ;

            $produit->update([
                'quantite' => $produit->quantite,
            ]);

            $produit_non_livre->update([
                'status' => "livré",
            ]);

            Mail::to($produit_non_livre->commande->adresse_client->email)->send(new SendMailProduitDisponibleClient($produit_non_livre, $produit));

            flashy()->success('Produit livré avec succès.');

            return redirect()->route('root_espace_admin_produits_non_livrer');

        }else {

            flashy()->error('La quantité du produit est insuffisante pour faire l\'opération');

            return redirect()->route('root_espace_admin_produits_non_livrer');
        }
    }

    public function validation_produit_non_livre(Request $request, $id){

        $produit_livre =  ProduitNonLivrer::findOrfail($request->id);

        $produit = Produit::findOrfail($produit_livre->produit_id);

            $produit->quantite = $produit->quantite + $produit_livre->quantite ;

            $produit->update([
                'quantite' => $produit->quantite,
            ]);

            $produit_livre->update([
            'status' => "non livré",
            ]);

            flashy()->info('Produit pas encore livré.');

            return redirect()->route('root_espace_admin_produits_non_livrer');

    }

}
