<?php

namespace App\Http\Controllers\Admin;

use SplFileInfo;
use App\Models\Image;
use App\Models\Partenaire;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PartenaireAdminController extends Controller
{
    public function index(){
        $partenaires = Partenaire::all();
        return view('espace-admin.partenaires.index', compact('partenaires'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|unique:partenaires,nom,except,id',
            'ordre_de_numero' => 'required|unique:partenaires,number_order,except,id|integer',
            'image' => 'required|image|mimes:jpg,png,jpeg|max:5048',
        ]);

        $save = save_image('partenaires', $request->image);

        if ($save != null) {
            Partenaire::create([
                'nom' =>$request->nom,
                'number_order' =>$request->ordre_de_numero,
                'image_id' => $save->id,
            ]);
        }

        flashy()->info('Partenaire créée avec succès.');

        return redirect()->route('root_espace_admin_index_partenaire');
    }


    public function update(Request $request){

        $request->validate([
            'nom' => 'required',
            'ordre_de_numero' => 'required|unique:partenaires,number_order,except,id|integer',

        ]);

        $partenaire = Partenaire::findOrfail($request->id);

        $partenaire->update([
            'nom' => $request->nom,
            'number_order' =>$request->ordre_de_numero,

        ]);

        flashy()->success('Partenaire #'. $request->id . ' modifié avec succès');

        return redirect()->route('root_espace_admin_index_partenaire');
    }

    public function update_image(Request $request){

        $request->validate([
            'image' => 'required|image|mimes:jpg,png,jpeg|max:5048',
        ]);

        $partenaire = Partenaire::findOrfail($request->id);

        $image = Image::findOrfail($partenaire->image_id);

        delete_image_path(path_image_partenaire(), $image->filename);

        $save = update_image('partenaires', $request->image, $image);

        if ($save != null) {

            flashy()->success('Image moddifiée avec succès');
        }

        return redirect()->route('root_espace_admin_index_partenaire');
    }

    public function delete(Request $request){

        $partenaire = Partenaire::findOrfail($request->id);

        $image = Image::findOrfail($partenaire->image_id);

        delete_image_path(path_image_partenaire(), $image->filename);

        $partenaire->delete();

        $image->delete();

        flashy()->error('Partenaire #'. $request->id . ' supprimé avec succès');

        return redirect()->back();
    }
}
