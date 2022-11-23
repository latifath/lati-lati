<?php

namespace App\Http\Controllers\Admin;


use App\Models\User;
use App\Models\Produit;
use App\Models\Commande;
use App\Models\Categorie;
use App\Models\Newsletter;
use Illuminate\Http\Request;
use App\Models\SousCategorie;
use App\Http\Controllers\Controller;

class HomeAdminController extends Controller
{
    public function index(){

        $nbr_role_client = User:: where('role', 'client')->get();

        $nbr_role_admin = User:: where('role', 'admin')->get();

        $commandes_effectuee = Commande:: where('status', 'attente paiement')->get();

        $commandes_en_attente = Commande:: where('status', 'en cours')->get();

        $commandes_annulee = Commande:: where('status', 'annulee')->get();

        $commandes_non_payee = Commande:: where('status', 'non payee')->get();

        $newsletters = Newsletter::all();

        $m_paiement = 0;

        // categories

        $categories = Categorie::all();

        // sous_categorie

        $sous_categories = SousCategorie::all();

        // produits

        $produits = Produit::all();



        return view('/espace-admin.index', compact('commandes_effectuee', 'commandes_en_attente', 'commandes_annulee', 'commandes_non_payee', 'newsletters', 'nbr_role_client', 'nbr_role_admin', 'categories', 'sous_categories', 'produits'));

    }

    public function news(){
        $newsletter_act = Newsletter::where('status', 'active')->get();

        $newsletter_desa = Newsletter::where('status', 'desactive')->get();

        return view('espace-admin.clients/newsletter', compact('newsletter_act', 'newsletter_desa'));

    }

    public function update(Request $request){
        $request->validate([

            'email' => 'required',
        ]);

        Newsletter::findOrfail($request->id)->update([

            "email" => $request->email,
        ]);

            flashy()->success('Newsletter #'. $request->id . 'modifiée avec succès');

            return redirect()->back();

    }

    public function bloquer($id)
    {
        $newsletter_bloquer = Newsletter::find($id);
        $newsletter_bloquer['status'] = 'desactive';
        $newsletter_bloquer->save();

        flashy()->error('Bloquée avec succès.');
        return redirect()->back();
    }

    public function debloquer($id)
    {
        $newsletter_debloquer = Newsletter::find($id);
        $newsletter_debloquer['status'] = 'active';
        $newsletter_debloquer->save();

        flashy()->success('Activée avec succès.');
        return redirect()->back();
    }

    public function delete(Request $request){

        $newsletter = Newsletter::findOrfail($request->id);

        $newsletter->delete();

        flashy()->error('Newsletter #'. $request->id . 'supprimée avec succès');

        return redirect()->back();
    }

}
