<?php

namespace App\Repositories;

use App\Models\Produit;


class PanierSessionRepository implements PanierInterfaceRepository
{
    	# Afficher le panier
	public function show () {
		return view("site-public.panier.show"); // resources\views\panier\show.blade.php
	}

	# Ajouter/Mettre à jour un produit du panier
	public function create (Produit $produit, $quantite) {
		$panier = session()->get("panier"); // On récupère le panier en session

		// Les informations du produit à ajouter
        if($produit->prix_promotionnel != null){
		$produit_details = [
			'name' => $produit->nom,
			'price' => $produit->prix_promotionnel,
			'quantity' => $quantite
		];
        }else{
        $produit_details = [
            'name' => $produit->nom,
            'price' => $produit->prix,
            'quantity' => $quantite
        ];
        }

		$panier[$produit->id] = $produit_details; // On ajoute ou on met à jour le produit au panier
		session()->put("panier", $panier); // On enregistre le panier
	}

	# Retirer un produit du panier
	public function delete (Produit $produit) {
		$panier = session()->get("panier"); // On récupère le panier en session
		unset($panier[$produit->id]); // On supprime le produit du tableau $panier
		session()->put("panier", $panier); // On enregistre le panier
	}

	# Vider le panier
	public function empty () {
		session()->forget("panier"); // On supprime le panier en session
		session()->forget("coupon");// On supprime le coupon en session
        session()->forget("stock"); // On supprime le stock en session
	}
}
