<?php

namespace App\Http\Controllers\Admin;

use App\Models\Categorie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SousCategorie;

class CategorieController extends Controller
{
    public function index(){

      $categories =  Categorie::orderBy('priority_order','ASC')->select('id','nom','priority_order')->get();

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
            'priority_order'=> 'required',
        ]);

        Categorie::findOrfail($request->id)->update([
            "nom" => $request->nom,
            "priority_order" => $request->priority_order,
        ]);


        flashy()->success('Catégorie #'. $request->id . 'modifiée avec succès');

        return redirect()->back();
    }

    public function store(Request $request)
    {
        $request->validate([

            'nom' => 'required',
            'priority_order' => 'required',
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

    public function updateOrder(Request $request){

        $categories = Categorie::all();
        foreach ($categories as $categorie)
        {
            foreach ($request->categorie as $categorie)
         {
            if ($categorie['id'] == $categorie->id) {
            $categorie->update(['priority_order' => $categorie['position']]);
            }
            }
            return response('Update Successfully.', 200);
            }


        // foreach ($categories as $categorie) {
        //     $categorie->timestamps = false; // To disable update_at field updation
        //     $id = $categorie->id;

        //         foreach ($request->priority_order as $priority) {
        //             if ($priority['id'] == $id) {
        //                 $categorie->update(['priority_order' => $priority['position']]);
        //             }
        //         }
        // }
        //     flashy()->success('Ordre de tire modifier avec succès');
    }

}
