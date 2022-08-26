<?php

namespace App\Http\Controllers;

use App\Models\Publicite;

class PubliciteController extends Controller
{
    public function index(){
        $publicites = Publicite::all();

        return view('site-public.index', compact('publicites'));
    }
}
