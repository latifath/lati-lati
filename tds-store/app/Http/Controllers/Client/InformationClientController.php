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
            'nom' => 'required|min:3|max:20|alpha',
            'prenom' => 'required',
            'email' => 'required|unique:clients,email,except,id',
            'telephone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:8',
            'pays' => 'required|alpha',
            'rue' => 'required',
            'ville' => 'required|max:255|alpha',
            'code_postal' => 'required|Numeric',
            'nom_entreprise' => 'required|max:255|alpha'

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
            'nom' => 'required|min:3|max:20|alpha',
            'prenom' => 'required',
            'email' => 'required|unique:clients,email,except,id',
            'telephone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:8',
            'pays' => 'required|alpha',
            'rue' => 'required',
            'ville' => 'required|max:255|alpha',
            'code_postal' => 'required|Numeric',
            'nom_entreprise' => 'required|max:255|alpha'
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
