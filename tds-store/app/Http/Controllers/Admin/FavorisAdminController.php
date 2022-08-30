<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Favoris;
use Illuminate\Http\Request;

class FavorisAdminController extends Controller
{
   public function index(){
    $favoris = Favoris::all();
    return view('espace-admin.favoris.index', compact('favoris'));
   }

   public function delete(Request $request){
    $delete = Favoris::findOrfail($request->id);
    $delete ->delete();

    flashy()->success('favoris retiré avec succès');

    return redirect()->route('root_site_public_favoris_index');
   }
}
