<?php

namespace App\Http\Controllers\Admin;

use App\Models\Categorie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SousCategorie;

class CategorieController extends Controller
{
    public function index(){

      $categories =  Categorie::all();

      return view('/espace-admin.categories.index', compact('categories'));
    }

    public function show($id){
        $categorie = Categorie::findOrfail($id);
        $detail_cat = SousCategorie::where('categorie_id', $id)->get();

        return view('/espace-admin.categories.details-categorie', compact('detail_cat', 'categorie'));
    }

    public function update(Request $request){
        $request->validate([
            'nom'=> 'required',
        ]);

        Categorie::findOrfail($request->id)->update([
            "nom" => $request->nom,
        ]);


        flashy()->success('Catégorie #'. $request->id . 'modifiée avec succès');

        return redirect()->back();
 }

public function store(Request $request)
    {
        $request->validate([

            'nom' => 'required',
        ]);

        Categorie::create($request->all());

        flashy()->info('Catégorie créée avec succès.');
        return redirect()->back();
    }

    public function delete(Request $request){

        $categorie = Categorie::findOrfail($request->id);

        $categorie->delete();

        flashy()->error('Catégorie #'. $request->id . 'supprimée avec succès');

        return redirect()->back();
    }



}
