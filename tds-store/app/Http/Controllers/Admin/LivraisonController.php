<?php

namespace App\Http\Controllers\Admin;

use App\Models\Livraison;
use App\Models\Expedition;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LivraisonController extends Controller
{
    public function index(){
        $livraisons_incomplète = Livraison::where('montant', null)->where('status', 'non')->get();

        $livraisons = Livraison::where('status', 'non')->get();

        $livraisons_valide = Livraison::where('status', 'oui')->where('montant', '!=', null)->get();

        return view('espace-admin.livraisons.index', compact('livraisons', 'livraisons_incomplète', 'livraisons_valide'));
    }

    public function update_frais(Request $request){
        $request->validate([
            'montant' => 'required',
        ]);

        Livraison::findOrfail($request->id)->update([
            'montant' =>$request->montant,
        ]);

        flashy()->info('Frais Expédition Ajouter avec succès.');
        return redirect()->back();
    }

    public function modification_statut(Request $request){
        $livraison_update_status = Livraison::findOrfail($request->id);
        $livraison_update_status->update([
            'status' => 'oui',
        ]);

        flashy()->success('Livraison effectuée avec succès');
        return redirect()->back();
    }

    public function index_expedition(){
        $expeditions = Expedition::all();
        return view('espace-admin.livraisons.expedition', compact('expeditions'));
    }

    public function store(Request $request){
        $request->validate([
            'ville' => 'required',
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
