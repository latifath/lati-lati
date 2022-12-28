<?php

namespace App\Http\Controllers;

use App\Models\Panier;
use App\Models\Promotion;
use Illuminate\Http\Request;

class PromotionController extends Controller
{

    public function verification_coupon(Request $request){

      $code = $request->code;

      $promotion = Promotion::where('code', $code)->where('status', 'en cours')->first();

      if (!$promotion){

        return redirect()->back()->withErrors(['msg' => 'Le coupon est invalide.']);

      }

      $request->session()->put('coupon', [

        'code' => $promotion->code,
        'type' => $promotion->type,
        'valeur' => $promotion->valeur,
      ]);

      return redirect()->back()->with('message', 'Le coupon est appliqué!');

    }

    public function delete(){

        request()->session()->forget('coupon');

        flashy()->error('Le coupon a été retiré.');
        return redirect()->back();
    }




}
