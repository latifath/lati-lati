<?php
namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Commande;
use App\Models\Paiement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RecapitutatifController extends Controller
{
public function index(){
    $commandes = " ";

    return view('espace-admin.recapitulatif.index', compact('commandes'));
}

public function show(Request $request){

    $date_debut = Carbon::parse($request->date_debut)->format('Y-m-d 01:00:00');
    $date_fin = Carbon::parse($request->date_fin)->format('Y-m-d 23:59:59');

    $commandes = Commande::where('created_at', '>', $date_debut)->where('created_at', '<', $date_fin )->get();

    return view('espace-admin.recapitulatif.index', compact('commandes', 'date_debut', 'date_fin'));
}

//    paiements

public function index_paiement(){
    $paiements = " ";
    return view('espace-admin.recapitulatif.index-paiement', compact('paiements'));
}

public function show_paiement(Request $request){

    $date_d = Carbon::parse($request->date_d)->format('Y-m-d 01:00:00');

    $date_f = Carbon::parse($request->date_f)->format('Y-m-d 23:59:59');

    $paiements = Paiement:: where('created_at', '>', $date_d)->where('created_at', '<', $date_f)->get();


    return view('espace-admin.recapitulatif.index-paiement', compact('paiements', 'date_d', 'date_f'));

}

}
