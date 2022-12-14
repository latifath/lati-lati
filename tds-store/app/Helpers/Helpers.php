<?php
use App\Models\User;
use Kkiapay\Kkiapay;
use App\Models\Client;
use App\Models\Invoice;
use App\Models\Commande;
use App\Models\Categorie;
use App\Models\Livraison;
use App\Models\Promotion;
use App\Models\Expedition;
use App\Models\Partenaire;
use App\Models\InvoiceItem;
use Illuminate\Support\Str;
use App\Models\AdresseClient;
use App\Models\Configuration;
use App\Models\SousCategorie;
use App\Models\AdresseLivraison;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client as ClientHttp;
use Illuminate\Database\Eloquent\Collection;

if(!function_exists('kkiapay')){
    function kkiapay($id_transaction){
        $public_key = "08785180ecc811ec848227abfc492dc7" ;
        $private_key = "tpk_08787891ecc811ec848227abfc492dc7";
        $secret = "tsk_08787892ecc811ec848227abfc492dc7";

        $kkiapay = new Kkiapay($public_key, $private_key, $secret, $sandbox=true);

        return $kkiapay->verifyTransaction($id_transaction);

    }
}

if(!function_exists('verify_kkiapay_transaction')){
    function verify_kkiapay_transaction($id_transaction, $m_invoice){

        if(kkiapay($id_transaction)->status == "SUCCESS" && kkiapay($id_transaction)->amount >= $m_invoice) {
            return true;
        }

        return false;

    }
}

if (!function_exists('categorie_menu')) {
    function categorie_menu(){
        $categories = Categorie::orderBy('id', 'ASC')->get();
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
         $partenaires = Partenaire::orderBy('number_order', 'ASC')->get();
         return $partenaires;
     }
}

if (!function_exists('one_sous_categorie')) {
     function one_sous_categorie($id) {
     $sous_categorie = SousCategorie::where('id', $id)->first();
     return $sous_categorie;
     };
}

// recupérer la categorie dans le table sous_categorie
if (!function_exists('all_sub_categorie_by_category')){
    function all_sub_categorie_by_category($category) {
        return  SousCategorie::where('categorie_id', $category)->get();
    };
}

if (!function_exists('one_categorie')) {
    function one_categorie($id) {
        $categorie = Categorie:: where('id', $id)->first();
        return $categorie;
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



if(!function_exists('adresselivraison')) {
    function adresselivraison($id) {
        $adresselivraisons = AdresseLivraison::findOrfail($id);
        return $adresselivraisons;
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

if(!function_exists('disabled_button_commande')){
    function disabled_button_commande($param1, $param2){
        if($param1 == $param2){
            return "disabled";
        }
    }
}


if(!function_exists('countries')){
    function countries(){
        $client = new ClientHttp();

        $url = "https://restcountries.com/v2/all";

        $response = $client-> request('GET', $url);

        $responseBody = json_decode($response->getBody());

        return $responseBody;

    }
}

if(!function_exists('villes')){
    function villes(){
        return Expedition::all();
    }
}

// Pour recuuperer le montant dans la table livraison
if(!function_exists('info_livraison')){
    function info_livraison($id){
        $livraisons = Livraison::where('commande_id', $id)->orderBy('id', 'DESC')->get();
        $l = "";
        foreach($livraisons as $livraison) {
            $l = $livraison;
        }
        return $l;
    }
}

// Vérifier si une livraison du commande a été crée pour une commande
if(!function_exists('verify_amount_livraison_exist')){
    function verify_amount_livraison_exist($livraison){
        if ($livraison) {
            return $livraison->montant;
        }
        return null;
    }
}


if(!function_exists('showSharer')){
    function showSharer($url, $message){

        echo '
            <a class="pr-3" href="https://facebook.com/sharer/sharer.php?u=' . urlencode($url) . '" target="_blank" rel="noopener" aria-label="Share on Facebook">
                <i class="fab fa-facebook-f"></i>
            </a>

            <a class="pr-3" href="https://twitter.com/intent/tweet/?text=' . urlencode($message) . '&url=' . urlencode($url) . '" target="_blank" rel="noopener" aria-label="Share on Twitter">
                <i class="fab fa-twitter"></i>
            </a>

            <a class="pr-3" href="mailto:?subject=' .  urlencode($message) . '&body=' . urlencode($url) . '" target="_self" rel="noopener" aria-label="Share by E-Mail">
                <i class="fa fa-envelope"></i>
            </a>

            <a class="pr-3" href="https://www.linkedin.com/shareArticle?mini=true&amp;url=' . urlencode($url) . '&title=' . urlencode($message) . '&summary=' . urlencode($message) . '&source=' . urlencode($url) . '" target="_blank" rel="noopener" aria-label="Share on LinkedIn">
                <i class="fab fa-linkedin-in"></i>
            </a>

            <a class="pr-3" href="whatsapp://send?text=' . urlencode($message) . '%20' . urlencode($url) . '" target="_blank" rel="noopener" aria-label="Share on WhatsApp">
                <i class="fab fa-whatsapp"></i>
            </a>

            <a class="pr-3" href="https://telegram.me/share/url?text=' . urlencode($message) . '&url=' . urlencode($url) . '" target="_blank" rel="noopener" aria-label="Share on Telegram">
                <i class="fab fa-telegram"></i>
            </a>
        ';
    }
}

if(!function_exists('generate_code_coupon')){
    function generate_code_coupon ($l){

        $chaine = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        return substr(str_shuffle(str_repeat($chaine , $l)), 0, $l);

    }
}

// Facture informations
if(!function_exists('invoice_items')) {
    function invoice_items($facture_id){
        return InvoiceItem::where('invoice_id', $facture_id)->get();
    }
}


if(!function_exists('invoice_terminate')) {
    function invoice_terminate($invoice){
        $invoice = Invoice::find($invoice);
        if (!$invoice) {
            return false;
        }
        return $invoice;
    }
}

if(!function_exists('customer_users')) {
    function customer_users(){
        return User::where('role', 'client')->get();
    }
}

if(!function_exists('client')) {
    function client($user){
        return Client::where('user_id', $user)->first();
    }
}

// ordre de priorité des categories

if (!function_exists('priority_by_category_tree')) {
    function priority_by_category_tree(){
        $categories = Categorie::where('priority_order', 3)->orderBy('id', 'DESC')->limit(8)->get();
        return $categories;

    }
}

if (!function_exists('priority_by_category_two')) {
    function priority_by_category_two(){
        $categories = Categorie::where('priority_order', 2)->orderBy('id', 'DESC')->get();
        return $categories;

    }
}

if (!function_exists('priority_by_category_one')) {
    function priority_by_category_one(){
        $categories = Categorie::where('priority_order', 1)->orderBy('id', 'DESC')->get();
        return $categories;

    }
}

if (!function_exists('priority_by_category_zero')) {
    function priority_by_category_zero(){
        $categories = Categorie::where('priority_order', 0)->orderBy('id', 'DESC')->get();
        return $categories;

    }
}
