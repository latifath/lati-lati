<?php

use App\Models\Image;
use GuzzleHttp\Client;
use App\Models\Produit;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

if (!function_exists('save_image')) {
    function save_image($dir, $file) {

        $extension = new SplFileInfo($file->getClientOriginalName());

        $filename = Str::random(16);

        $filepath = $file->storeAs($dir, $filename . '.' . $extension->getExtension(), 'public');

        if($filepath != null){
            $picture = Image::create([
                'filename' => $filename. '.' . $extension->getExtension(),
                'mimetype' => $file->getClientMimeType()
            ]);
        } else{
            $picture = null;
        }
        return $picture;
    }
}

// fiche technique;

if (!function_exists('save_produit')) {
    function upload_produit($dir, $file, $name) {

        $extension = new SplFileInfo($file->getClientOriginalName());

        $filepath = $file->storeAs($dir, $name . '.' . $extension->getExtension(), 'public');

        return $filepath;
    }
}

if (!function_exists('save_produit')) {
    function save_produit($file, $filepath, $name) {

        $extension = new SplFileInfo($file->getClientOriginalName());

        if($filepath != null){
            $picture = Image::create([
                'filename' => $name. '.' . $extension->getExtension(),
                'mimetype' => $file->getClientMimeType()
            ]);
        } else{
            $picture = null;
        }
        return $picture;
    }
}



if (!function_exists('update_image')) {
    function update_image($dir, $file, $image) {

        $extension = new SplFileInfo($file->getClientOriginalName());

        $filename = Str::random(16);

        // location chemin image
        $filepath = $file->storeAs($dir, $filename . '.' . $extension->getExtension(), 'public');

        if($filepath != null){
            $picture = $image->update([
                'filename' => $filename. '.' . $extension->getExtension(),
                'mimetype' => $file->getClientMimeType()
            ]);
        } else{
            $picture = null;
        }
        return $picture;
    }
}

if (!function_exists('delete_image_path')) {
    function delete_image_path($path, $name) {
        $path = public_path() . '/' . $path . $name;

        if(file_exists($path)) {
            return unlink($path);
        }
    }
}

if (!function_exists('path_image_partenaire')) {
    function path_image_partenaire() {
         return "storage/partenaires/";
    }
}

if (!function_exists('path_image_produit')) {
    function path_image_produit() {
        return "storage/produits/";
    }
}

if (!function_exists('path_image_publicite')) {
    function path_image_publicite() {
        return "storage/publicites/";
    }
}

if (!function_exists('path_fiche_technique')) {
    function path_fiche_technique() {
        return "storage/produits/fiche_technique/";
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

if(!function_exists('favoris')){
    function favoris($id){
        $produit_favoris = Produit::where('id', $id)->first();
        return $produit_favoris;
    }
}
