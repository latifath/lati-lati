<?php

namespace App\Http\Controllers\Admin;

use SplFileInfo;
use App\Models\Image;
use App\Models\Publicite;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PubliciteAdminController extends Controller
{
    public function index(){

        $publicites = Publicite::all();

        return view('espace-admin.publicites.index', compact('publicites'));

       }

       public function store(Request $request){
        $request->validate([
            'nom' => 'required',
            'message' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg|max:5048',

        ]);
        $save = save_image(public_path('images/publicites'), $request->image);

        if ($save != null) {
        Publicite::create([
                'nom' => $request->nom,
                'message' => $request->message,
                'image_id' => $save->id,
            ]);
        }

        flashy()->info('Publicité ajoutée avec succès.');

        return redirect()->back();

    }

    public function update(Request $request){
        $request->validate([
            'nom' => 'required',
            'message' => 'required',
        ]);

        Publicite::findOrfail($request->id)->update([
            'nom' => $request->nom,
            'message' => $request->message,
        ]);

        flashy()->success('Publicité modifiée avec succès');

        return redirect()->route('root_espace_admin_publicites');

    }

    public function update_image(Request $request){
        $request->validate([
            'image' => 'required|image|mimes:jpg,png,jpeg|max:5048',
        ]);

        $publicite = Publicite::findOrfail($request->id);

        $image = Image::findOrfail($publicite->image_id);

        delete_image_path(path_image_publicite(), $image->filename);

        $save = update_image(public_path('images/publicites'), $request->image, $image);

        if($save != null) {
            flashy()->success('Image modifiée avec succès');
        }

        return redirect()->route('root_espace_admin_publicites');

    }

    public function delete(Request $request){

        $publicite = Publicite::findOrfail($request->id);

        $image = Image::findOrfail($publicite->image_id);

        delete_image_path(path_image_publicite(), $image->filename);

        $publicite->delete();

        $image->delete();

        flashy()->error('Publicité #'. $request->id . 'supprimée avec succès');

        return redirect()->back();
    }

}
