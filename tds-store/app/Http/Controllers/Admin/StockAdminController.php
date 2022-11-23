<?php

namespace App\Http\Controllers\Admin;

use App\Models\Stock;
use App\Models\Produit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class StockAdminController extends Controller

{
public function index(){

    $stocks =Stock::all();

    $produits = Produit::all();

    return view('espace-admin.stocks.stock', compact('stocks', 'produits'));
}

public function create(){
    $produits = Produit::all();

    return view('espace-admin.stocks.create-stock', compact('produits'));
}

public function store(Request $request){

    $request->validate([
        'quantite' => 'required|integer|min:1',
        'prix_unitaire' => 'required',
        'produit' => 'required',
    ]);

    $produit = Produit::findOrfail($request->produit);

    Stock::create([
        'quantite' => $request->quantite,
        'prix_unitaire' => $request->prix_unitaire,
        'montant' => $request->quantite * $request->prix_unitaire,
        'nom_produit' => $produit->nom,
        'produit_id' => $produit->id,
    ]);


    $produit_quantite = $produit->quantite + $request->quantite;

    $produit->update([
        'quantite' => $produit_quantite,
    ]);

    flashy()->info('Stock ajouté avec succès');

    return redirect()->back();

}

public function update(Request $request){

    $request->validate([
        'quantite' => 'required',
    ]);

     $stock = Stock::findOrfail($request->id);

     $produit = Produit::findOrfail($stock->produit_id);

    Stock::findOrfail($request->id)->update([
        "quantite" => $request->quantite,
        "montant" => $request->quantite * $request->prix_unitaire,
    ]);

     $produit_quantite = $produit->quantite + $request->quantite - $stock->quantite;

    $produit->update([
        'quantite' => $produit_quantite,
     ]);

    flashy()->success('Stock #'. $request->id . 'modifiée avec succès');

    return redirect()->back();
}

public function delete(Request $request){

    $stock = Stock::findOrfail($request->id);

    $produit = Produit::findOrfail($stock->produit_id);

    $produit_quantite = $produit->quantite - $stock->quantite;

    $produit->update([

        'quantite' => $produit_quantite,
    ]);

    $stock->delete();

    flashy()->error('stock #'. $request->id .  'retiré avec succès');

    return redirect()->back();
}
//    correction stock
    public function index_correction(){

        $produits = Produit::all();

        return view('espace-admin.stocks.correction-stock', compact('produits'));
    }

  public function edit_correction(Request $request){

        $request->validate([
            'quantite' => 'required',
        ]);

        Produit::findOrfail($request->id)->update([
            "quantite" => $request->quantite,
        ]);

        flashy()->success('Produit #'. $request->id . 'corrigé avec succès');

        return redirect()->back();
  }
}
