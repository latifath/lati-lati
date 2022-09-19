<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Produit;
use App\Models\Commande;
use Illuminate\Http\Request;
use App\Models\AdresseClient;
use App\Models\CommandeProduit;
use App\Models\AdresseLivraison;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailNewCommandeAdmin;
use App\Mail\SendMailNewCommandeClient;
use App\Mail\SendMailProduitInsuffisantAdmin;
use App\Mail\SendMailProduitInsuffisantClient;
use App\Http\Requests\CreateValidationCommandeFormRequest;
use App\Models\ProduitNonLivrer;

class CommandeController extends Controller
{

    public function valider_commande() {
        // pour recupérer les donnés dans la base d'un utilisateur connecté
        $adresseclient = AdresseClient::where('email', auth()->user()->email)->first();

        return view("site-public.commandes.validation-commande", compact('adresseclient'));
    }

    public function test(Request $request){
        $request->validate([
            'latitude'=> 'required',
        ]);
    }

    public function validation(Request $request) {

        // dd('e');
        $request->validate([
            'nom'=> 'required',
            'prenom'=> 'required|min:3',
            'email'=> 'required|email',
            'telephone'=> 'required|min:8|regex:/^([0-9\s\-\+\(\)]*)$/|min:8',
            'pays'=> 'required',
            'rue'=> 'required|min:4',
            'ville'=> 'required|min:3',
            'code_postal'=> 'required',
            'payment' => 'required',
        ]);

        // if($request->nomLivraison != null ) {
        //     $request->validate([
        //         'nomLivraison'=> 'required',
        //         'prenomLivraison'=> 'required|min:3',
        //         'emailLivraison'=> 'required|email',
        //         'telephoneLivraison'=> 'required|min:8|regex:/^([0-9\s\-\+\(\)]*)$/|min:8',
        //         'paysLivraison'=> 'required',
        //         'rueLivraison'=> 'required|min:4',
        //         'villeLivraison'=> 'required|min:3',
        //         'code_postalLivraison'=> 'required|number',
        //     ]);
        // }

        if(session('panier')){


            $clt = AdresseClient::Create(
                [
                'nom'=> request('nom'),
                'prenom'=> request('prenom'),
                'email'=> request('email'),
                'user_id' => auth()->user()->id,
                'telephone'=> request('telephone'),
                'pays'=> request('pays'),
                'rue'=> request('rue'),
                'ville'=> request('ville'),
                'code_postal'=> request('code_postal')
            ]);


            if($request->nomLivraison != null ) {
                $adr = AdresseLivraison::Create([
                    'nom'=> request('nomLivraison'),
                    'prenom'=> request('prenomLivraison'),
                    'email'=> request('emailLivraison'),
                    'user_id' => auth()->user()->id,
                    'telephone'=> request('telephoneLivraison'),
                    'pays'=> request('paysLivraison'),
                    'rue'=> request('rueLivraison'),
                    'ville'=> request('villeLivraison'),
                    'code_postal'=> request('code_postalLivraison')
                ]);
            }else{
                $adr = AdresseLivraison::Create([
                    'nom'=> request('nom'),
                    'prenom'=> request('prenom'),
                    'email'=> request('email'),
                    'user_id' => auth()->user()->id,
                    'telephone'=> request('telephone'),
                    'pays'=> request('pays'),
                    'rue'=> request('rue'),
                    'ville'=> request('ville'),
                    'code_postal'=> request('code_postal')
                ]);
            }

            if(request()->session()->has('coupon')){
                $promotion = request()->session()->get('coupon')['code'] ;
            }

            // creation de la commande
            $commande = Commande::create([
                'adresse_client_id' => $clt->id,
                'adresse_livraison_id' => $adr->id,
                'user_id' => auth()->user()->id,
                'status' => 'attente paiement',
                'tva' => $request->pays == "Benin" ? configuration()->tva : '0',
                'promotion' => $promotion ?? null,
            ]);

            //    creation et ajout d'information dans le champs commandeProduit
            foreach (session('panier') as $key => $value) {
               $cde_pdt = CommandeProduit::create([
                    'commande_id' => $commande->id,
                    'quantite' => $value['quantity'],
                    'prix' => $value['price'],
                    'produit_id' => $key,
                ]);

                $produit = Produit::findOrfail($key);

                if($produit->quantite < $value['quantity']){

                    ProduitNonLivrer::create([
                        'commande_id' =>$commande->id,
                        'produit_id' => $key,
                        'quantite' => $value['quantity'] - $produit->quantite,
                        'status' => 'non livré'
                    ]);

                    $stock_restant = 0;

                }else{
                    $stock_restant = $produit->quantite - $value['quantity'];
                }


                $produit->update([
                    'quantite' => $stock_restant,
                ]);

            }

            //  pour vider le panier apres avoir cliquer sur le button passer la commande
            session()->forget("panier");

            request()->session()->forget('coupon');

            Mail::to($clt->email)->send(new SendMailNewCommandeClient($clt, $commande, $adr));

            Mail::to('assiawou-latifa.monsia@epitech.eu')->send(new SendMailNewCommandeAdmin($clt, $commande, $adr));

            $stock_session = session('stock') ;

            if($request->session()->has('stock')){

                Mail::to($clt->email)->send(new SendMailProduitInsuffisantClient( $stock_session, $cde_pdt));

                Mail::to('assiawou-latifa.monsia@epitech.eu')->send(new SendMailProduitInsuffisantAdmin($stock_session, $cde_pdt));

                //pour vider la session stock quant on click sur le button passer la commande

                session()->forget("stock");
            }


            return redirect()->route('root_site_public_payer_la_commande', [$commande->id, $request->payment]);
        } else{
            return redirect('/');
        }
    }


    public function payer_la_commande($cmd, $type_paiement) {

        $commande = Commande::findOrfail($cmd);
        $sub_total = 0;
        $commande_produits = CommandeProduit::where('commande_id', $commande->id)->get();

        foreach ($commande_produits as $key => $value) {
            $sub_total = $sub_total + $value->prix * $value->quantite ;
        }


        return view("site-public.commandes.validation-payement", compact('commande', 'sub_total','type_paiement'));

    }

    public function edit_adresse_facturation(Request $request) {

        $request->validate([
            'nom'=> 'required',
            'prenom'=> 'required|min:3',
            'email'=> 'required|email',
            'telephone'=> 'required|min:8|regex:/^([0-9\s\-\+\(\)]*)$/|min:8',
            'pays'=> 'required',
            'rue'=> 'required|min:4',
            'ville'=> 'required|min:3',
            'code_postal'=> 'required',
        ]);

        AdresseClient::findOrfail($request->id)->update([
            "nom" => $request->nom,
            "prenom" => $request->prenom,
            "email" => $request->email,
            "telephone" => $request->telephone,
            "pays" => $request->pays,
            "rue" => $request->rue,
            "ville" => $request->ville,
            "code_postal" => $request->code_postal,
        ]);

        flashy()->success('Adresse de facturation modifiée avec succès');
        return redirect()->back();
    }

    public function edit_adresse_livraison(Request $request) {

        $request->validate([
            'nom'=> 'required',
            'prenom'=> 'required|min:3',
            'email'=> 'required|email',
            'telephone'=> 'required|min:8|regex:/^([0-9\s\-\+\(\)]*)$/|min:8',
            'pays'=> 'required',
            'rue'=> 'required|min:4',
            'ville'=> 'required|min:3',
            'code_postal'=> 'required',
        ]);

        AdresseLivraison::findOrfail($request->id)->update([
            "nom" => $request->nom,
            "prenom" => $request->prenom,
            "email" => $request->email,
            "telephone" => $request->telephone,
            "pays" => $request->pays,
            "rue" => $request->rue,
            "ville" => $request->ville,
            "code_postal" => $request->code_postal,
        ]);

         $commande = Commande::where('adresse_livraison_id', $request->id)->first();

         $commande->update([
            'tva' => $request->pays == "Benin" ? configuration()->tva : '0',
         ]);

        flashy()->success('Adresse de livraison modifiée avec succès');

        return redirect()->back();
    }

    // annulation commande

    public function annuler_commande($id) {

        $commande = Commande::findOrfail($id);
        $produit_commandes = CommandeProduit::where('commande_id', $commande->id)->get();

        $commande->update([
            'status' => 'annulee',
        ]);

        foreach($produit_commandes as $produit_commande) {
            $produit = Produit::findOrfail($produit_commande->produit_id);
            $produit->quantite += $produit_commande->quantite;

            $produit->update([
                'quantite' => $produit->quantite,
            ]);

        }

        session()->forget("stock");

        flashy()->error('Commande #' . $id . ' annulée avec succès');
        return redirect('/')
        ;

    }
}
