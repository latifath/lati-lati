<?php

namespace App\Http\Controllers\Admin;

use SplFileInfo;
use App\Models\Publicite;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PubliciteAdminController extends Controller
{
    public function index(){

        $publicites = Publicite::all();


        return view('espace-admin.publicites.index', compact('publicites'));

       }

       public function create(Request $request){
        $request->validate([
            'nom' => 'required',
            'message' => 'required',
            'path' => 'required|image',

        ]);
        $newImageName = time() . '-' . $request->nom . '.' . $request->path->extension();

        // location chemin image
        $request->path->move(public_path('publicites'), $newImageName);
        Publicite::create([
            'nom' => $request->nom,
            'message' => $request->message,
            'path' => $newImageName,
        ]);

        flashy()->info('Publicité ajoutée avec succès.');

        return redirect()->back();

    }

        public function update(Request $request){
            $request->validate([
                'nom' => 'required',
                'message' => 'required',
                'path' => 'required|image',
            ]);

            $newImageName = time() . '-' . $request->nom . '.' . $request->path->extension();

            // location chemin image
            $request->path->move(public_path('publicites'), $newImageName);

            Publicite::findOrfail($request->id)->update([
                'nom' => $request->nom,
                'message' => $request->message,
                'path' => $newImageName,
            ]);

            flashy()->success('Publicité modifiée avec succès');

            return redirect()->route('root_espace_admin_publicites');

        }

        public function delete(Request $request){
            $delete = Publicite::findOrfail($request->id);

            $delete->delete();

            flashy()->error('Publicité #'. $request->id . 'supprimée avec succès');

            return redirect()->back();
        }

}
