<?php

namespace App\Repositories;

use App\Models\Produit;

interface PanierInterfaceRepository {

    // Afficher le panier
	public function show();

	// Ajouter un produit au panier
	public function create(Produit $produit, $quantite);

	// Retirer un produit du panier
	public function delete(Produit $produit);

	// Vider le panier
	public function empty();

}

?>
