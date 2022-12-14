<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class FavorisClientController extends Controller
{
    public function index(){

        $favoris = DB::table('produit_user')->where('user_id', auth()->user()->id)->get();

        return view('espace-client.favoris.index', compact('favoris'));
       }

       public function delete(Request $request){

        DB::table('produit_user')->where('id',$request->id)->delete();

        flashy()->success('favoris retiré avec succès');

        return redirect()->route('root_site_public_favoris_index');
    }
 }
