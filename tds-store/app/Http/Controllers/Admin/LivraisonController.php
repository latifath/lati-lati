<?php

namespace App\Http\Controllers\Admin;

use App\Models\Commande;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Expedition;

class LivraisonController extends Controller
{
    public function index(){
        $livraisons = Commande::where("status", "en cours")->get();

        return view('espace-admin.livraisons.index', compact('livraisons'));
    }

    public function index_expedition(){
        $expeditions = Expedition::all();
        return view('espace-admin.livraisons.expedition', compact('expeditions'));
    }

    public function store(Request $request){
        $request->validate([

            'ville' => 'required|',
            'montant' => 'required|integer',
        ]);

        Expedition::create([
            'ville' =>$request->ville,
            'montant' =>$request->montant,
        ]);

        flashy()->info('Expédition créée avec succès.');
        return redirect()->back();
    }

    public function update(Request $request){
        $request->validate([
            'ville' =>'required',
            'montant' => 'required|integer',
        ]);

        Expedition::findOrfail($request->id)->update([
            'ville' =>$request->ville,
            'montant' =>$request->montant,
        ]);

        flashy()->success('Expédition #'. $request->id . 'modifiée avec succès');
        return redirect()->back();

    }

    public function delete(Request $request){
        $delete = Expedition::findOrfail($request->id);
        $delete->delete();

        flashy()->error('Expédition #'. $request->id . 'supprimée avec succès');
        return redirect()->back();
    }
}
