<?php

namespace App\Http\Controllers;

use App\Models\Favoris;
use App\Models\Produit;
use App\Models\Publicite;
use App\Models\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    public function index()
    {
        $produits_latest = Produit::orderBy('id', 'DESC')->limit(6)->get();

        $publicite_latest = Publicite::orderBy('id', 'DESC')->limit(1)->first();

        $publicites = Publicite::all();

        return view('site-public.index', compact('produits_latest', 'publicites', 'publicite_latest'));
    }


    public function showproduit(produit $id)
    {
        return $id;

    }

    // pour enregistrer le mail inserer dans le newsletter

    public function newsletter(Request $request){
        //  pour la verification de la validiter du mail

        $request->validate([
            'email' => 'required|string|email|unique:newsletters,email,except,id',
        ]);

        $news = Newsletter:: create([
            "email" => $request->email,
        ]);

        flashy()->success('Abonée');

        return redirect()->back();
    }
    // End
}
