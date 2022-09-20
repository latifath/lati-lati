<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class FavorisAdminController extends Controller
{
   public function index(){
    $favoris = (DB::select('select * from produit_user'));
    return view('espace-admin.favoris.index', compact('favoris'));
   }

   public function delete(Request $request){
    DB::table('produit_user')->where('produit_id', '=',  $request->id)
                            ->delete();
    flashy()->success('favoris retiré avec succès');

    return redirect()->route('root_site_public_favoris_index');
   }
}
