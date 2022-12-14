<?php

namespace App\Http\Controllers\Admin;

use SplFileInfo;
use App\Models\Image;
use App\Models\Produit;
use App\Models\Categorie;
use App\Models\Newsletter;
use Illuminate\Http\Request;
use App\Models\SousCategorie;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailProduitNewsletter;

class ProduitAdminController extends Controller
{
    public function index(){

        $produits = Produit::orderBy('id', 'DESC')->get();

        $produits_rupture = Produit::where('quantite', '<', '5')->get();

        return view('espace-admin.produits.index-produit', compact('produits', 'produits_rupture'));
    }

    public function edit($id){

        $produit = Produit::findOrfail($id);

        $sous_categories = SousCategorie::all();

        $categories = Categorie::all();

        return view('espace-admin.produits.edit-produit', compact( 'produit', 'sous_categories', 'categories'));
    }

    public function show($id){
        $produit = Produit::findOrfail($id);
        return view('espace-admin.produits.show-produit', compact('produit'));
    }

    public function add_vue(){

        $sous_categories = SousCategorie::all();

        $categories = Categorie::all();

        $produit = new Produit() ;

        return view('espace-admin.produits.create-produit', compact('sous_categories', 'categories', 'produit'));
    }

    public function store(Request $request){

        $request->validate([
            'nom'=> 'required',
            'quantite' => 'required|integer',
            'prix' => 'required|between:0,99.99',
            'description' => 'required',
            'sous_categorie' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg|max:5048',
        ]);
        $save = save_image('produits', $request->image);

        if ($save != null) {
            $produit = Produit::create([
                'nom' => $request->nom,
                'quantite' => $request->quantite,
                'prix' => $request->prix,
                'description' => $request->description,
                'sous_categorie_id' => $request->sous_categorie,
                'image_id' => $save->id
            ]);
        }

        $newsletters = Newsletter::where('status', 'active')->get();

        foreach ($newsletters as $newsletter) {

            Mail::to($newsletter->email)->send(new SendMailProduitNewsletter($newsletter, $produit));
        }

        flashy()->info('Produit cr???? avec succ??s.');

        return redirect()->route('root_espace_admin_index_produit');
    }

    public function update(Request $request){

        $request->validate([
            'nom'=> 'required',
            'quantite' => 'required|integer',
            'prix' => 'required|between:0,99.99',
            'description' => 'required',
            'sous_categorie' => 'required',

        ]);

        Produit::findOrfail($request->id)->update([
            "nom" => $request->nom,
            "quantite" => $request->quantite,
            "prix" => $request->prix,
            "description" => $request->description,
            'sous_categorie_id' => $request->sous_categorie
        ]);

        flashy()->success('Produit #'. $request->id . 'modifi?? avec succ??s');

        return redirect()->route('root_espace_admin_show_produit', $request->id);
    }

    public function update_image(Request $request){
        $request->validate([
            'image' => 'required|image|mimes:jpg,png,jpeg|max:5048',
        ]);

        $produit = Produit::findOrfail($request->id);

        $image = Image::findOrfail($produit->image_id);

        delete_image_path(path_image_produit(), $image->filename);

        $save = update_image('produits', $request->image, $image);

        if ($save != null) {
            flashy()->success('Image modifi??e avec succ??s');
        }
        return redirect()->route('root_espace_admin_show_produit', $request->id);
    }

    public function delete(Request $request){

        $produit = Produit::findOrfail($request->id);

        $image = Image::findOrfail($produit->image_id);

        delete_image_path(path_image_produit(), $image->filename);

        $produit->delete();

        $image->delete();

        flashy()->error('Produit #'. $request->id . 'supprim?? avec succ??s');

        return redirect()->route('root_espace_admin_index_produit');
    }

    // pour les images
    public function show_images($id){

        $produit = Produit::findOrfail($id);

        $produit->with('images')->get();

        return view('espace-admin.produits.show-images', compact('produit'));
    }

    public function create_image(Request $request){

        $request->validate([
            'produit_id' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg|max:5048',
        ]);

        $save = save_image('produits', $request->image);

        if ($save != null) {

            $produit = Produit::findOrfail($request->produit_id);

            $produit->images()->attach($save->id);
       }

        flashy()->info('Image ajout??e avec succ??s.');

        return redirect()->back();
    }

    public function index_image(){

        $images = Image::all();
        return view('espace-admin.produits.images', compact('images'));
    }


    public function delete_image(Request $request){

        $image = Image::findOrfail($request->id);

        delete_image_path(path_image_produit(), $image->filename);

        $image->delete();

        flashy()->error('Image #'. $request->id . 'supprim??e avec succ??s');

        return redirect()->route('root_espace_admin_index_produit');
    }

    public function create_fiche_technique(Request $request){

        $request->validate([
            'id' => 'required',
            'fichier' => 'required',
        ]);

        // $name = str_replace(' ', '_', $request->nom);
        // $upload = upload_fiche('produits/fiche_technique', $request->fichier, $name);
        // $save  = save_fiche($request->fichier, $upload, $name);
        $save = save_image('produits/fiche_technique', $request->fichier);

        if ($save != null) {

             Produit::findOrfail($request->id)->update([
                 'file_id' => $save->id,
             ]);
        }
        flashy()->info('Fiche Technique ajout??e avec succ??s.');

        return redirect()->back();
    }

    public function delete_technical_sheet(Request $request){

        $produit = Produit::findOrfail($request->id);

        $image = Image::findOrfail($produit->file_id);

        delete_image_path(path_fiche_technique(), $image->filename);

        $save = $produit->update([
            'file_id' => null
        ]);

        flashy()->info('Fiche Technique ajout??e avec succ??s.');

        return redirect()->route('root_espace_admin_index_produit');
    }

}
