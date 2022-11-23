<?php

namespace App\Http\Controllers\Client;

use App\Models\Commande;
use Illuminate\Http\Client\Request;
use App\Http\Controllers\Controller;
use App\Models\Invoice;

class PaiementClientController extends Controller
{
    public function index(){

      $bills = Invoice::where('user_id', auth()->user()->id)->get();

        return view('espace-client.paiement.index', compact('bills'));
    }
}
