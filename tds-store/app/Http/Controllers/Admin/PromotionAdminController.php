<?php

namespace App\Http\Controllers\Admin;

use App\Models\Promotion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PromotionAdminController extends Controller
{
    public function index(){

        $promotions = Promotion::all();

        return view('espace-admin.promotions.index', compact('promotions'));
    }

    public function store(Request $request){
        $request->validate([

            'code_coupon' => 'required|unique:promotions,code,except,id|max:8',
            'type' => 'required',
            'valeur' => 'required',
            'status' => 'required',

        ]);
        Promotion::create(['code' => $request->code_coupon, 'type' => $request->type, 'valeur' => $request->valeur, 'priority_order'=> $request->priorite, 'status' =>$request->status]);

        flashy()->info('Promotion ajoutée avec succès.');

        return redirect()->back();

    }

    public function update(Request $request){

        $request->validate([

            'code_coupon' => 'required|unique:promotions,priority_order,except,id|max:8',
            'type' => 'required',
            'valeur' => 'required',
            'status' => 'required',
        ]);

        Promotion::findOrfail($request->id)->update([
            "code" => $request->code_coupon,
            "type" => $request->type,
            "valeur" => $request->valeur,
            "status" => $request->status,
        ]);


        flashy()->success('Promotion #'. $request->id . 'modifiée avec succès');

        return redirect()->back();
    }

    public function delete(Request $request){

        $promotion = Promotion::findOrfail($request->id);

        $promotion->delete();

        flashy()->error('Promotion #'. $request->id . 'supprimée avec succès');

        return redirect()->back();
    }

}
