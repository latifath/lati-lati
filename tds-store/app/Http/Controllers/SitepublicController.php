<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Stock;
use App\Models\Client;
use App\Models\Produit;
use App\Models\Commande;
use App\Models\Paiement;
use Illuminate\Http\Request;
use App\Models\SousCategorie;

class SitepublicController extends Controller
{
    public function produits(){

        $tout_produits = Produit::paginate(8);

        return view ('site-public.produits.produit', compact('tout_produits'));

    }

    public function all_produit_par_sous_categorie($cat, $sous_cat){
        $sous_categorie = SousCategorie::where('slug', $sous_cat)->first();
        $sous_categories_produits = Produit::where('sous_categorie_id', $sous_categorie->id)->get();

        return view ('site-public.produits.sous-categorie-produit', compact('cat', 'sous_cat' ,'sous_categories_produits'));

    }

    public function show_produit_par_sous_categorie($cat, $sous_cat, $pdt){

        $produit = Produit::where('slug', $pdt)->first();
        $images = Image::where('produit_id', $produit->id)->get();
        $last_image = Image::where('produit_id', $produit->id)->first();
        $sous_categorie = SousCategorie::where('slug', $sous_cat)->first();
        $sous_categories_produits = Produit::where('sous_categorie_id', $sous_categorie->id)->get();


        return view ('site-public.produits.detail-produit', compact('produit', 'images', 'last_image', 'cat', 'sous_cat', 'sous_categories_produits' ));

    }

    public function verification(){
        return  view('/verification-auth');
    }

}
