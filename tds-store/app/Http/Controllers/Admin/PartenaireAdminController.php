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
        $extension = new SplFileInfo($request->logo->getClientOriginalName());

        $filepath = $request->file('logo')->storeAs('logo', $request->nom . '.' . $extension->getExtension(), 'public');


        Partenaire::findOrfail($request->id)->update([
            "nom" => $request->nom,
            "logo" => $filepath,
        ]);


        flashy()->success('Partenaire #'. $request->id . 'modifiée avec succès');

        return redirect()->back();
    }

    public function create(Request $request)
    {
        $request->validate([

            'nom' => 'required|unique:partenaires,nom,except,id',
            'logo' => 'required|image|dimensions:min_width=1',
        ]);

        $extension = new SplFileInfo($request->logo->getClientOriginalName());

        $filepath = $request->file('logo')->storeAs('logo', $request->nom . '.' . $extension->getExtension(), 'public');

        Partenaire::create([
            'nom' =>$request->nom,
            'logo' => $filepath,
        ]);

        flashy()->info('Partenaire créée avec succès.');
        return redirect()->back();
    }

    public function delete(Request $request){

        $partenaire = Partenaire::findOrfail($request->id);

        $partenaire->delete();

        flashy()->error('Partenaire #'. $request->id . 'supprimée avec succès');

        return redirect()->back();
    }

}
