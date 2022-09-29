<?php
use App\Models\Pays;
use App\Models\User;
use Kkiapay\Kkiapay;
use App\Models\Image;
use App\Models\Client;
use App\Models\Favoris;
use App\Models\Produit;
use App\Models\Commande;
use App\Models\Paiement;
use App\Models\Categorie;
use App\Models\Promotion;
use App\Models\Partenaire;
use App\Models\AdresseClient;
use App\Models\Configuration;
use App\Models\SousCategorie;
use App\Models\CommandeProduit;
use App\Models\AdresseLivraison;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

if(!function_exists('kkiapay')){
    function kkiapay($id_transaction){
        $public_key = "08785180ecc811ec848227abfc492dc7" ;
        $private_key = "tpk_08787891ecc811ec848227abfc492dc7";
        $secret = "tsk_08787892ecc811ec848227abfc492dc7";

        $kkiapay = new Kkiapay($public_key, $private_key, $secret, $sandbox=true);

        return $kkiapay->verifyTransaction($id_transaction);

    }
}

if(!function_exists('couleur_text_1')) {
    function couleur_text_1() {
         return "color :  #01674e";
    }
}

if(!function_exists('couleur_background_1')) {
    function couleur_background_1() {
         return "background-color :  #01674e";
    }
}

if(!function_exists('couleur_text_2')) {
    function couleur_text_2() {
         return "color :  #ea0513";
    }
}

if(!function_exists('couleur_background_2')) {
    function couleur_background_2() {
         return "background-color :  #ea0513";
    }
}

if(!function_exists('couleur_text_3')){
    function couleur_text_3(){
        return "color: #1C1C1C";
    }
}

if(!function_exists('couleur_principal')){
    function couleur_principal(){
        return "background-color: #EDF1FF";
    }
}

if(!function_exists('couleur_blanche')){
    function couleur_blanche(){
        return "color: #ffff";
    }
}



if (!function_exists('categorie_menu')) {
    function categorie_menu(){
        $categories = Categorie::all() ;
        return $categories;

    }
}

if (!function_exists('sous_categories_menu')) {
    function sous_categories_menu($id){
        $sous_categories = SousCategorie::where('categorie_id', $id)->get();
        return $sous_categories;
    }
}

if (!function_exists('partenaires_logo')) {
     function partenaires_logo() {
         $partenaires = Partenaire::all();
         return $partenaires;
     }
}

if (!function_exists('one_sous_categorie')) {
     function one_sous_categorie($id) {
     $sous_categorie = SousCategorie::where('id', $id)->first();
     return $sous_categorie;
     };
}
if (!function_exists('one_categorie')) {
    function one_categorie($id) {
        $categorie = Categorie:: where('id', $id)->first();
        return $categorie;
    }
}

// #20c997 entente
//  :#ee740d reste

// pour faire appel au montant total vu qu'elle apparait sur plusieurs pages
if(!function_exists('total_commande')){
    function total_commande($id){
        $total = 0;
        $compdt = CommandeProduit::where('commande_id', $id)->get();

        foreach ($compdt as $key => $value) {
            $total = $total + $value->prix * $value->quantite ;
        }
        return $total;
    }
}
// end

if(!function_exists('detail_commande')) {
    function detail_commande($id){
        $commande_produit = CommandeProduit:: where('commande_id', $id)->get();
        return $commande_produit;
    }
}

if(!function_exists('produit')) {
    function produit($id){
        $produit = Produit::findOrfail($id);
        return $produit;
    }
}
// pour recupérer les informations du AdresseClient qui a payé

if(!function_exists('adresseclient')) {
    function adresseclient($id) {
        $adresseclients = AdresseClient::findOrfail($id);
        return $adresseclients;
    }
}
// end


if(!function_exists('account_commande')) {
    function account_commande($id){
        $account = Paiement::where('commande_id', $id)->first();
        return $account;
    }
}

if(!function_exists('compte_com')){
    function compte_com($id){
        $com = Paiement::findOrfail($id);
        return $com;
    }
}

if(!function_exists('commande')){
    function commande($id){
        $commande = Commande::where('id', $id)->first();
        return $commande;

    }
}

if(!function_exists('adresselivraison')) {
    function adresselivraison($id) {
        $adresselivraisons = AdresseLivraison::findOrfail($id);
        return $adresselivraisons;
    }
}

if(!function_exists('exist_commande_paiement')) {
    function exist_commande_paiement($id){
        return Paiement::where('commande_id', $id)->first();
    }
}

if(!function_exists('last_image_produit')){
    function last_image_produit($id_produit){
        return Image::where('produit_id', $id_produit)->first();
    }
}

if(!function_exists('configuration')){
    function configuration(){
        return Configuration::where('id', 1)->first();
    }
}

if(!function_exists('montant_ttc')){
    function montant_ttc($montant, $adresselivraison_id){

        $adresselivraisons = AdresseLivraison::findOrfail($adresselivraison_id);

        if($adresselivraisons->pays == 'Benin') {
            return $montant * 1.18;
        }else{
            return $montant;
        }
    }
}

if(!function_exists('apply_tva')){
    function apply_tva(){

        if(configuration()->tva = 1){
            return '18%';
        }else{
            return '0%';
        }

    }
}

if(!function_exists('valeur_coupon')){
    function valeur_coupon(){

        if((request()->session()->has('coupon'))){
            if(request()->session()->get('coupon')['type'] == "percent_of"){
                return request()->session()->get('coupon')['valeur'] . '%';
            }else{
                return number_format(request()->session()->get('coupon')['valeur'] , '0', '.', ' ') . 'F CFA';
            }
        }
    }
}

if(!function_exists('valeur_coupon_cmde')){
    function valeur_coupon_cmde($code){

        $promotion = Promotion::where('code', $code)->first();

        if($promotion){
            if($promotion->type == "percent_of"){
                return $promotion->valeur . '%';
            }else{
                return number_format($promotion->valeur, '0', '.', ' ') . 'FCFA';
            }
        }
        return null;
    }
}

if(!function_exists('montant_apres_reduction_sans_session')){
    function montant_apres_reduction_sans_session($montant, $coupon){

        $promotion = Promotion::where('code', $coupon)->first();

        if($promotion){
            if($promotion->type == "percent_of"){
                return ($montant - $montant * ($promotion->valeur/100));
            }else{
                return ($montant - $promotion->valeur);
            }
        }
        return $montant;
    }
}

if(!function_exists('montant_apres_reduction')){
    function montant_apres_reduction($montant){

        if(request()->session()->has('coupon')){
            if(request()->session()->get('coupon')['type'] == "percent_of"){
                return ($montant - $montant * (request()->session()->get('coupon')['valeur']/100));
            }else{
                return ($montant - request()->session()->get('coupon')['valeur']);
            }
        }
        return $montant;
    }
}


if(!function_exists('information_client')){
    function information_client(){

        return Client::where('user_id', auth()->user()->id)->first();

    }
}


// pour le nmbre total de like

if(!function_exists('count_favoris')){
    function count_favoris(){
        $nbr = DB::table('produit_user')->where('user_id', auth()->user()->id)->get();
        return $nbr->count();
    }
}

if(!function_exists('pays')){
    function pays(){
        return Pays::all();

    }
}

if(!function_exists('paiements')){
    function paiements(){
        return  Paiement::all();
    }
}

if(!function_exists('disabled_button_commande')){
    function disabled_button_commande($param1, $param2){
        if($param1 == $param2){

            return "disabled";

        }else{

        }
    }
}
