<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function connexion(){
        return view('auth/login');
    }

    public function inscription(){
        return view('auth/register');
    }

    public function deconnexion(){
        Auth::logout();
        flashy()->error('Vous êtes maintenant déconnecté !');
        return redirect()->route('root_index');
    }

    public function index_utilisateur(){
        $users = User::all();
        return view('espace-admin/index-utilisateur', compact('users'));
    }

    public function edit_utilisateur(Request $request){

            $request->validate([
                'role'=> 'required',
            ]);

            User::findOrfail($request->id)->update([
                "role" => $request->role,
            ]);

            flashy()->success('Rôle utilisateur modifié avec succès');

            return redirect()->back();
     }

     public function delete(Request $request, $id){

        $user = User::findOrfail($request->id);

        $user->delete();

        flashy()->error('utilisateur supprimé avec succès');

        return redirect()->back();
    }

}
