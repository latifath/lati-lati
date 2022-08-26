<?php

namespace App\Http\Controllers\Admin;

use App\Models\Produit;
use App\Models\Categorie;
use Illuminate\Http\Request;
use App\Models\SousCategorie;
use App\Http\Controllers\Controller;

class SousCategorieAdminController extends Controller
{
   public function index_sous_categorie(){

    $sous_categories = SousCategorie::all();

    $categories = Categorie::all();

    return view('espace-admin.sous-categories.index', compact('sous_categories', 'categories'));
   }

   public function update(Request $request){
    $request->validate([
        'nom'=> 'required',
    ]);

    SousCategorie::findOrfail($request->id)->update([
        "nom" => $request->nom,
    ]);


    flashy()->success('Sous-Catégorie #'. $request->id . 'modifiée avec succès');

    return redirect()->back();
}

    public function create(Request $request)
    {
        $request->validate([

            'nom' => 'required',
            'categorie' => 'required',
        ]);

        SousCategorie::create(['nom' => $request->nom, 'categorie_id' => $request->categorie]);

        flashy()->info('Sous-catégorie créée avec succès.');

        return redirect()->back();
    }

    public function delete(Request $request){

        $sous_categorie = SousCategorie::findOrfail($request->id);

        $sous_categorie->delete();

        flashy()->error('Sous-catégorie #'. $request->id . 'supprimée avec succès');

        return redirect()->back();
    }

    public function show($id){
        $sous_cat_pdt = Produit::where('sous_categorie_id', $id)->get();
        return view('espace-admin.sous-categories.details-sous-categorie', compact('sous_cat_pdt'));
    }
}
