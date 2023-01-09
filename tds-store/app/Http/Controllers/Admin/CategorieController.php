<?php

namespace App\Http\Controllers\Admin;

use App\Models\Categorie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SousCategorie;

class CategorieController extends Controller
{
    public function index()
    {

        $categories =  Categorie::orderBy('priority_order', 'ASC')->get();

        return view('/espace-admin.categories.index', compact('categories'));
    }

    public function show($id)
    {
        $categorie = Categorie::findOrfail($id);
        $detail_cat = SousCategorie::where('categorie_id', $id)->get();

        return view('/espace-admin.categories.details-categorie', compact('detail_cat', 'categorie'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'priority_order' => 'required|unique:categories,priority_order,except,id|integer',
        ]);

        Categorie::findOrfail($request->id)->update([
            "nom" => $request->nom,
            "priority_order" => $request->priority_order,
        ]);


        flashy()->success('Catégorie #' . $request->id . 'modifiée avec succès');

        return redirect()->back();
    }

    public function store(Request $request)
    {
        $request->validate([

            'nom' => 'required',
            'priority_order' => 'required|unique:categorie,priority_order,except,id|integer',
        ]);

        Categorie::create($request->all());

        flashy()->info('Catégorie créée avec succès.');
        return redirect()->back();
    }

    public function delete(Request $request)
    {

        $categorie = Categorie::findOrfail($request->id);

        $categorie->delete();

        flashy()->error('Catégorie #' . $request->id . 'supprimée avec succès');

        return redirect()->back();
    }

    public function updateOrder(Request $request)
    {
        $categories = Categorie::all();

        foreach ($categories as $category) {
            foreach ($request->order as $order) {
                if ($order['id'] == $category->id) {
                    $category->update([
                        'priority_order' => $order['position']
                    ]);
                }
            }

        }
        return response()->json('ordre de priorité de la catégorie modifier avec succès' , 200);
    }
}
