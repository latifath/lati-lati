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
        $extension = new SplFileInfo($request->path->getClientOriginalName());

        $filepath = $request->file('path')->storeAs('publicites', $request->nom . '.' . $extension->getExtension(), 'public');

        Publicite::create([
            'nom' => $request->nom,
            'message' => $request->message,
            'path' => $filepath,
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

            $extension = new SplFileInfo($request->path->getClientOriginalName());

            $filepath = $request->file('path')->storeAs('publicites', $request->nom . '.' . $extension->getExtension(), 'public');

            Publicite::findOrfail($request->id)->update([
                'nom' => $request->nom,
                'message' => $request->message,
                'path' => $filepath,
            ]);

            flashy()->success('Publicité modifiée avec succès');

            return redirect()->back();

        }

        public function delete(Request $request){
            $delete = Publicite::findOrfail($request->id);

            $delete->delete();

            flashy()->error('Publicité #'. $request->id . 'supprimée avec succès');

            return redirect()->back();
        }

}
