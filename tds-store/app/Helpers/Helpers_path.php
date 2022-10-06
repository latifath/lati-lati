<?php

use App\Models\Image;
use App\Models\Produit;
use Illuminate\Support\Str;

if (!function_exists('save_image')) {
    function save_image($dir, $file) {

        $extension = new SplFileInfo($file->getClientOriginalName());

        $filename = Str::random(16);

        // location chemin image
        $filepath = $file->move($dir, $filename . '.' . $extension->getextension());

        if($filepath != null){
            $picture = Image::create([
                'filename' => $filename. '.' . $extension->getExtension(),
            ]);
        } else{
            $picture = null;
        }
        return $picture;
    }
}

if (!function_exists('path_image_partenaire')) {
    function path_image_partenaire() {
         return "images/partenaires/";
    }
}

if (!function_exists('path_image_produit')) {
    function path_image_produit() {
        return "images/produits/";
    }
}

if (!function_exists('path_image_publicite')) {
    function path_image_publicite() {
        return "images/publicites/";
    }
}

if (!function_exists('path_image')) {
    function path_image($id) {
       $image = Image::find($id);

        if($image){
            return $image;
        }else{
            return null;
        }
    }
}

if(!function_exists('images')){
    function images($id){
         return Produit::find($id);
    }
}
