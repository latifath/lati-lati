<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Commande;
use Illuminate\Http\Request;
use App\Mail\SendMailPassword;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ClientAdminController extends Controller
{
    public function index(){

        $utilisateurs = User::where('role', 'client')->get();

        return view('/espace-admin.clients.index', compact('utilisateurs'));
    }

     public function show($id){

        $client = User::findOrfail($id);
        $commandes = Commande::where('user_id', $client->id)->get();

        return view('/espace-admin.clients.show', compact('client', 'commandes'));
    }

    // public function delete(User $user)
    // {
    //     $user->delete();
    //     return redirect()->route('root_espace_admin_clients_index')
    //                     ->with('success','User deleted successfully');
    // }

    // public function delete($id){
    //     $user = User::find($id);

    //     flashy()->success('utilisateur supprimé avec succes');
    //     return redirect()->route('root_espace_admin_clients_index');
    //     // return view('/espace-admin.clients.index', compact('user'));
    // }

    public function add(){
        return view('espace-admin.clients.create');
    }

    public function create(Request $request)
    {
    $request->validate([
        'name' => 'required',
        'email' => 'required|unique:users,email,except,id',
        'password' => 'required|string|min:6|max:12',
    ]);

    $user = User::create(['name' => $request->name, 'email' =>$request->email, 'password' => Hash::make($request->password)]);

    if (request()->has('feature')) {

        Mail::to($user->email)->send(new SendMailPassword($user));
    }


    flashy()->info('Client crée avec succès.');
    return redirect()->back();

    }

    public function delete(Request $request){

        $user = User::findOrfail($request->id);

        $user->delete();

        flashy()->error('client supprimé avec succès');

        return redirect()->back();
    }

}
