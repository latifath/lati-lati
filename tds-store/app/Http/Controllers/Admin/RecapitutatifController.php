<?php
namespace App\Http\Controllers\Admin;

use DateTime;
use Carbon\Carbon;
use App\Models\Invoice;
use App\Models\Commande;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RecapitutatifController extends Controller
{
public function index(){
    $commandes = null;

    return view('espace-admin.recapitulatif.index', compact('commandes'));
}

public function show(Request $request){
    $request->validate([
        'date_debut' =>'required|date',
        'date_fin' =>'required|date|after:date_debut',
    ]);
    $limite =(new DateTime("+4 years"))->format('Y-m-d');

        $date_debut = Carbon::parse($request->date_debut)->format('Y-m-d 01:00:00');
        $date_fin = Carbon::parse($request->date_fin)->format('Y-m-d 23:59:59');

        $commandes = Commande::where('created_at', '>', $date_debut)->where('created_at', '<', $date_fin )->get();

    return view('espace-admin.recapitulatif.index', compact('commandes', 'date_debut', 'date_fin'));
}

//    paiements

public function index_paiement(){

    $payment = null;

    return view('espace-admin.recapitulatif.index-paiement', compact('payment'));
}

public function show_paiement(Request $request){

    $request->validate([
        'date_de_debut' =>'required|date',
        'date_de_fin' =>'required|date|after:date_de_debut',
    ]);

    $limite =(new DateTime("+4 years"))->format('Y-m-d');

    $date_d = Carbon::parse($request->date_de_debut)->format('Y-m-d 01:00:00');

    $date_f = Carbon::parse($request->date_de_fin)->format('Y-m-d 23:59:59');

    $payment = Invoice:: where('date_paid', '>', $date_d)->where('date_paid', '<', $date_f)->get();

    return view('espace-admin.recapitulatif.index-paiement', compact('payment', 'date_d', 'date_f'));

}

}
