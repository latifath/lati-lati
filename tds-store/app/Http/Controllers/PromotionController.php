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

        flashy()->error('Le coupon est invalide');

        return redirect()->back();

      }

      $request->session()->put('coupon', [

        'code' => $promotion->code,
        'type' => $promotion->type,
        'valeur' => $promotion->valeur,
      ]);

      flashy()->success('Le coupon est appliqué');

      return redirect()->back();

    }

    public function delete(){

        request()->session()->forget('coupon');

        flashy()->error('Le coupon a été retiré.');
        return redirect()->back();
    }




}
