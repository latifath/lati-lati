<?php

namespace App\Http\Controllers\Client;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InformationClientController extends Controller
{

    public function index(){

        return view('espace-client.information-client');
    }

    public function store(Request $request) {

        $this->validate($request, [
            'nom' => 'required',
            'prenom' => 'required',
            'email' => 'required|unique:clients,email,except,id',
            'telephone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:8',
            'pays' => 'required',
            'rue' => 'required',
            'ville' => 'required',
            'code_postal' => 'required',
            'nom_entreprise' => 'required'

         ]);

        Client::Create(
            [
            'nom'=> $request->nom,
            'prenom'=> $request->prenom,
            'email'=> $request->email,
            'user_id' => auth()->user()->id,
            'telephone'=> $request->telephone,
            'pays'=> $request->pays,
            'rue'=> $request->rue,
            'ville'=> $request->ville,
            'code_postal'=> $request->code_postal,
            'nom_entreprise'=> $request->nom_entreprise
        ]);

        flashy()->success('Information client mis à jour avec succès');

        return redirect()->back();

    }

    public function update(Request $request){

        $this->validate($request, [
            'nom' => 'required',
            'prenom' => 'required',
            'email' => 'required',
            'telephone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:8',
            'pays' => 'required',
            'ville' => 'required',
            'code_postal' => 'required',
            'nom_entreprise' => 'required'
        ]);
        Client::where('user_id', auth()->user()->id)->first()->update([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'pays' => $request->pays,
            'ville' => $request->ville,
            'code_postal' => $request->code_postal,
            'nom_entreprise' => $request->nom_entreprise
        ]);

        flashy()->success('Information client mis à jour avec succès');

        return redirect()->back();

    }
}
