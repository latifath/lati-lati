<?php

namespace App\Http\Controllers;

use App\Models\Publicite;

class PubliciteController extends Controller
{
    public function index(){
        $publicites = Publicite::orderBy('number_order', 'ASC')->get();

        return view('site-public.index', compact('publicites'));
    }
}
