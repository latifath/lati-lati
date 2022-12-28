<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Produit;
use App\Models\SousCategorie;

class SitepublicController extends Controller
{
    public function produits(){

        $tout_produits = Produit::orderBy('id', 'DESC')->paginate(8);

        return view ('site-public.produits.produit', compact('tout_produits'));

    }

    public function all_produit_par_sous_categorie($cat, $sous_cat){
        $sous_categorie = SousCategorie::where('slug', $sous_cat)->first();
        $sous_categories_produits = Produit::where('sous_categorie_id', $sous_categorie->id)->orderBy('id', 'DESC')->get();

        // pour pagination
        $sous_categorie_produits = Produit::where('sous_categorie_id', $sous_categorie->id)->orderBy('id', 'DESC')->paginate(8);

        return view ('site-public.produits.sous-categorie-produit', compact('cat', 'sous_cat' ,'sous_categories_produits', 'sous_categorie_produits'));

    }

    public function show_produit_par_sous_categorie($cat, $sous_cat, $pdt){

        $produit = Produit::where('slug', $pdt)->first();

        if($produit != null){

            $produit->with('images');
            $sous_categorie = SousCategorie::where('slug', $sous_cat)->first();
            $sous_categories_produits = Produit::where('sous_categorie_id', $sous_categorie->id)->orderBy('id', 'DESC')->get();

            return view ('site-public.produits.detail-produit', compact('produit', 'cat', 'sous_cat', 'sous_categories_produits'));
        }
    }

    public function verification(){
        return  view('/verification-auth');
    }
}
