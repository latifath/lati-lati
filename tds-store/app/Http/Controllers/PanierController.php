<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use Illuminate\Http\Request;
use App\Repositories\PanierInterfaceRepository;

class PanierController extends Controller
{
    public $discount;
    protected $panierRepository; // L'instance BasketSessionRepository

    /**
     * __construct
     *
     * @param  PanierInterfaceRepository $panierRepository
     * @return void
     */
    public function __construct(PanierInterfaceRepository $panierRepository) {
    	$this->panierRepository = $panierRepository;
    }

    # Affichage du panier
    public function show () {
    	return view("site-public.panier.show"); // resources\views\basket\show.blade.php
    }

    # Ajout d'un produit au panier
    public function create (Produit $produit, Request $request) {

    	// Validation de la requête
    	$this->validate($request, [
    		"quantite" => "numeric|min:1"
    	]);

        // pour comparer la quantite dans le panier et le quantité du stock

        if ( $request->quantite > $produit->quantite) {

            $stock = session()->get("stock");

            // Les informations du produit à ajouter
            $stock_details = [
                'name' => $produit->nom,
                'qte' => ($request->quantite - $produit->quantite)

            ];

            $stock[$produit->id] = $stock_details;

            session()->put("stock", $stock);

        }
        if ( $request->quantite <= $produit->quantite) {

            $stock = session()->forget("stock");
        }


    	// Ajout/Mise à jour du produit au panier avec sa quantité
    	$this->panierRepository->create($produit, $request->quantite);

    	// Redirection vers le panier avec un message
    	return redirect()->route("root_show_panier")->withMessage("Produit ajouté au panier");


    }
    // Suppression d'un produit du panier
    public function delete (Produit $produit) {

    	// Suppression du produit du panier par son identifiant
    	$this->panierRepository->delete($produit);

        $stock = session()->get("stock"); // On récupère le stock en session
		unset($stock[$produit->id]); // On supprime le produit du tableau $stock
		session()->put("stock", $stock); // On enregistre le stock

    	// Redirection vers le stock
    	return back()->withMessage("Produit retiré du stock");
    }

    // Vider la panier
    public function empty () {

    	// Suppression des informations du panier en session
    	$this->panierRepository->empty();

    	// Redirection vers le panier
    	return back()->withMessage("Panier vidé");

    }


}
