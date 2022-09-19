<?php

namespace App\Http\Controllers\Admin;

use SplFileInfo;
use App\Models\Partenaire;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PartenaireAdminController extends Controller
{
    public function index(){
        $partenaires = Partenaire::all();
        return view('espace-admin.partenaires.index-partenaire', compact('partenaires'));
    }

    public function update(Request $request){
        $request->validate([
            'nom' => 'required|unique:partenaires,nom,except,id',
            'logo' => 'required|image|dimensions:min_width=1',
        ]);

        $newImageName = time() . '-' . $request->nom . '.' . $request->logo->extension();

        // location chemin image
        $request->logo->move(public_path('partenaires'), $newImageName);

        Partenaire::findOrfail($request->id)->update([
            "nom" => $request->nom,
            "logo" => $newImageName ,
        ]);


        flashy()->success('Partenaire #'. $request->id . ' modifiée avec succès');

        return redirect()->route('root_espace_admin_index_partenaire');
    }

    public function create(Request $request)
    {
        $request->validate([

            'nom' => 'required|unique:partenaires,nom,except,id',
            'logo' => 'required|image|dimensions:min_width=1',
        ]);

        $newImageName = time() . '-' . $request->nom . '.' . $request->logo->extension();

        // location chemin image
        $request->logo->move(public_path('partenaires'), $newImageName);
        Partenaire::create([
            'nom' =>$request->nom,
            'logo' => $newImageName ,
        ]);

        flashy()->info('Partenaire créée avec succès.');

        return redirect()->route('root_espace_admin_index_partenaire');
    }

    public function delete(Request $request){

        $partenaire = Partenaire::findOrfail($request->id);

        $partenaire->delete();

        flashy()->error('Partenaire #'. $request->id . ' supprimée avec succès');

        return redirect()->back();
    }

}
