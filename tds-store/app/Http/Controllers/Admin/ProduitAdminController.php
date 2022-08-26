<?php

namespace App\Http\Controllers\Admin;

use SplFileInfo;
use App\Models\Image;
use App\Models\Produit;
use App\Models\Categorie;
use App\Models\Newsletter;
use Illuminate\Http\Request;
use App\Models\SousCategorie;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailProduitNewsletter;

class ProduitAdminController extends Controller
{
    public function index(){

        $produits = Produit::all();

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

    public function update(Request $request){
        $request->validate([
            'nom'=> 'required',
            'quantite' => 'required',
            'prix' => 'required',
            'description' => 'required',
            'categorie' => 'required',
            'sous_categorie' => 'required'

        ]);

        Produit::findOrfail($request->id)->update([
            "nom" => $request->nom,
            "quantite" => $request->quantite,
            "prix" => $request->prix,
            "description" => $request->description,
            'categorie_id' => $request->categorie,
            'sous_categorie_id' => $request->sous_categorie

        ]);
        flashy()->success('Produit #'. $request->id . 'modifiée avec succès');

        return redirect()->route('root_espace_admin_show_produit', $request->id);
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
            'quantite' => 'required',
            'prix' => 'required',
            'description' => 'required',
            'categorie' => 'required',
            'sous_categorie' => 'required'
        ]);

        $produit = Produit::create(['nom' => $request->nom, 'quantite' => $request->quantite, 'prix' => $request->prix, 'description' => $request->description, 'categorie_id' => $request->categorie, 'sous_categorie_id' => $request->sous_categorie]);

        $newsletters = Newsletter::where('status', 'active')->get();

        foreach ($newsletters as $newsletter) {

            Mail::to($newsletter->email)->send(new SendMailProduitNewsletter($newsletter, $produit));
        }

        flashy()->info('Produit créée avec succès.');

        return redirect()->route('root_espace_admin_index_produit');
    }

    public function delete(Request $request){

        $produit = Produit::findOrfail($request->id);

        $produit->delete();

        flashy()->error('Produit #'. $request->id . 'supprimée avec succès');

        return redirect()->route('root_espace_admin_index_produit');
    }


    // pour les images

    public function create_image(Request $request){

        $request->validate([
            'nom'=> 'required|unique:images,nom,except,id',
            'path' => 'required|image',
            'produit_id' => 'required',
        ]);

        $extension = new SplFileInfo($request->path->getClientOriginalName());

        $filepath = $request->file('path')->storeAs('articles', $request->nom . '.' . $extension->getExtension(), 'public');
        Image::create([
            'nom' => $request->nom,
            'path' => $filepath,
            'produit_id' =>  $request->produit_id,
        ]);


        flashy()->info('Image ajoutée avec succès.');

        return redirect()->back();
    }

    public function index_image(){

        $images = Image::all();
        return view('espace-admin.produits.images', compact('images'));
    }

    public function update_image(Request $request){

        $request->validate([
            'nom'=> 'required',
            'path' => 'required|image',
        ]);

        $extension = new SplFileInfo($request->path->getClientOriginalName());

        $filepath = $request->file('path')->storeAs('articles', $request->nom . '.' . $extension->getExtension(), 'public');

        Image::findOrfail($request->id)->update([
            "nom" => $request->nom,
            "path" => $filepath,

        ]);

        flashy()->success('Image #'. $request->id . 'modifiée avec succès');

        return redirect()->route('root_espace_admin_show_images');
    }

    public function delete_image(Request $request){

        $image = Image::findOrfail($request->id);

        $image->delete();

        flashy()->error('Image #'. $request->id . 'supprimée avec succès');

        return redirect()->route('root_espace_admin_index_produit');
    }

    public function show_images($id){

        $produit = Produit::findOrfail($id);

        $produit_images = Image::where('produit_id', $id)->get();

        return view('espace-admin.produits.show-images', compact('produit_images', 'produit'));
    }

}
