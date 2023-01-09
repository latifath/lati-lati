<?php

namespace App\Http\Controllers;

use App\Models\Favoris;
use App\Models\Produit;
use App\Models\Publicite;
use App\Models\Newsletter;
use App\Models\Partenaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    public function index()
    {
        $produits_latest = Produit::orderBy('id', 'DESC')->limit(8)->get();

        $publicite_latest = Publicite::orderBy('number_order', 'ASC')->limit(1)->first();

        $publicites = Publicite::orderBy('number_order', 'ASC')->get();

        $partenaires = Partenaire::orderBy('number_order', 'ASC')->get();

        return view('site-public.index', compact('produits_latest', 'publicites', 'publicite_latest', 'partenaires'));
    }

    public function tdsstoremaps()
    {
        return view('site-public.maps');
    }


    public function showproduit(produit $id)
    {
        return $id;

    }

    // pour enregistrer le mail inserer dans le newsletter

    public function newsletter(Request $request){
        //  pour la verification de la validiter du mail
        $request->validate([
            'email' => 'required|email',
        ]);

        $newsletter = Newsletter::where('email', $request->email)->first();

        if($newsletter) {
            $newsletter->delete();

            flashy()->error('Désabonnée');
            return redirect()->back();
        }

        Newsletter:: create([
            "email" => $request->email,
        ]);

        flashy()->success('Abonée');
        return redirect()->back();

    }
}
