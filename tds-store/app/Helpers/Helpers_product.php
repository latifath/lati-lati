<?php

use App\Models\Image;
use App\Models\Produit;
use App\Models\SousCategorie;


if(!function_exists('produit')) {
    function produit($id){
        $produit = Produit::findOrfail($id);
        return $produit;
    }
}

if(!function_exists('last_image_produit')){
    function last_image_produit($id_produit){
        return Image::where('produit_id', $id_produit)->first();
    }
}

if(!function_exists('produits_non_livrer')){
    function produits_non_livrer($id){
        return  Produit::where('id', $id)->first();
    }
}

// Tous les produits d\'une sous-catégorie

if(!function_exists('produits_sous_categorie')){
    function produits_sous_categorie($sous_cat){
        $sous_categorie = SousCategorie::where('slug', $sous_cat)->first();
        $sous_categories_produits = Produit::where('sous_categorie_id', $sous_categorie->id)->get();
        return $sous_categories_produits;
    }
}
