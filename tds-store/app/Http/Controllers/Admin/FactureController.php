<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Invoice;
use App\Models\Commande;
use App\Models\Livraison;
use App\Models\InvoiceItem;
use Illuminate\Http\Request;
use MercurySeries\Flashy\Flashy;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailMontantExpeditionClient;

class FactureController extends Controller
{
    public function index($id){
        $invoice = invoice::findOrfail($id);

        return view('espace-admin.livraisons.factures.generate', compact('invoice'));
    }

    public function store_facture(Request $request){

        $request->validate([
            'tva' => 'required',
            'user_id' => 'required',
            'livraison_id' => 'required',

        ]);

        $invoice = Invoice::create([
            'tva' => $request->tva,
            'status' => 0,
            'user_id'  => $request->user_id,
        ]);

        $livraison = Livraison::findOrfail($request->livraison_id);
        $livraison->update([
            'invoice_id' => $invoice->id,
        ]);

        flashy()->info('Facture Mise en place avec succès');

        return redirect()->route('root_espace_admin_index_facture', $invoice->id);
    }

    public function store_facture_item(Request $request){

        $request->validate([
            'invoice_id' => 'required',
            'description' => 'required',
            'price' => 'required|integer',
            'quantity' => 'required|integer',

        ]);

        $invoice = Invoice::findOrfail($request->invoice_id);

        InvoiceItem::create([
            'user_id' => $invoice->user_id,
            'invoice_id' => $invoice->id,
            'description' => $request->description,
            'price' =>$request->price,
            'quantity' => $request->quantity,
            'amount' => $request->price * $request->quantity,
        ]);

        flashy()->info('Facture crée avec succès');

        return redirect()->route('root_espace_admin_index_facture', $invoice->id);
    }

    public function update(Request $request){
        $request->validate([
            'description' => 'required',
            'prix' => 'required',
            'quantite' => 'required',
        ]);
        InvoiceItem::findOrfail($request->id)->update([
            'description' => $request->description,
            'price' => $request->prix,
            'quantity' => $request->quantite,
            'amount' => $request->prix * $request->quantite,
        ]);


        flashy()->success('Facture modifiée avec succès');
        return redirect()->back();
    }

    public function confirm(Request $request){
        $invoice = Invoice::findOrfail($request->id);

        $invoice_item = InvoiceItem::where('invoice_id', $invoice->id)->get();
        $sub_total = 0;
        $total = 0;

        foreach ($invoice_item as $item) {
            $sub_total += $item->amount;
            if($invoice->tva == 1) {
                $total += $item->amount * 1.18;
            }
            else{
                $total += $item->amount;
            }
        }

        $invoice->update([
            'status' => 1,
            'subtotal' => $sub_total,
            'total' => $total
        ]);

        $user_email = User::findOrfail($invoice->user_id);
        Mail::to(client($user_email->email))->send(new SendMailMontantExpeditionClient($invoice));

        flashy()->success('Facture validée avec succès');
        return redirect()->route('root_espace_admin_index_livraison');
    }
}
