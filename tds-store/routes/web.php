<?php

use App\Models\ProduitNonLivrer;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PanierController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\PayementController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\SitepublicController;
use App\Http\Controllers\Admin\FactureController;
use App\Http\Controllers\Admin\CategorieController;
use App\Http\Controllers\Admin\HomeAdminController;
use App\Http\Controllers\Admin\LivraisonController;
use App\Http\Controllers\Admin\StockAdminController;
use App\Http\Controllers\Admin\ClientAdminController;
use App\Http\Controllers\Client\HomeClientController;
use App\Http\Controllers\Admin\FavorisAdminController;
use App\Http\Controllers\Admin\ProduitAdminController;
use App\Http\Controllers\Admin\CommandeAdminController;
use App\Http\Controllers\Admin\PaiementAdminController;
use App\Http\Controllers\Admin\RecapitutatifController;
use App\Http\Controllers\Admin\PromotionAdminController;
use App\Http\Controllers\Admin\PubliciteAdminController;
use App\Http\Controllers\Client\FavorisClientController;
use App\Http\Controllers\Admin\PartenaireAdminController;
use App\Http\Controllers\Client\CommandeClientController;
use App\Http\Controllers\Client\PaiementClientController;
use App\Http\Controllers\Admin\SousCategorieAdminController;
use App\Http\Controllers\Client\InformationClientController;
use App\Http\Controllers\Admin\ProduitNonLivrerAdminContoller;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('root_index');

Route::get('/produits', [SitepublicController::class, 'produits'])->name('root_sitepublic_produits');

Route::get('/p/{categorie}/{sous_categorie}', [SitepublicController::class, 'all_produit_par_sous_categorie'])->name('root_sitepublic_all_produit_par_sous_categorie');

Route::get('/p/{categorie}/{sous_categorie}/{produit}', [SitepublicController::class, 'show_produit_par_sous_categorie'])->name('root_sitepublic_show_produit_par_sous_categorie');

Route::get('panier', [PanierController::class, 'show'])->name('root_show_panier');

Route::post('panier/ajouter/{produit}', [PanierController::class, 'create'])->name('root_create_panier');

Route::get('/panier/supprimer/{produit}', [PanierController::class, 'delete'])->name('root_delete_panier');

Route::get('panier/vider', [PanierController::class, 'empty'])->name('root_empty_panier');

Route::get('validation-commande', [CommandeController::class, 'valider_commande'])->name('root_site_public_validation_commande')->middleware('auth');

Route::post('validation-commande/create', [CommandeController::class, 'validation'])->name('root_site_public_validation');

Route::post('validation-commande/update/adresse-facturation', [CommandeController::class, 'edit_adresse_facturation'])->name('root_site_public_edit_adresse_facturation');

Route::post('validation-commande/update/adresse-livraison', [CommandeController::class, 'edit_adresse_livraison'])->name('root_site_public_edit_adresse_livraison');

Route::get('annulation-commande/{id}', [CommandeController::class, 'annuler_commande'])->name('root_site_public_annuler_commande');

// Route::get('validation-commande/confirmation', [CommandeController::class, 'confirmation'])->name('root_site_public__confirmation');

Route::get('validation-commmande/{id}/payer-la-commande/type-paiement-{payment}', [CommandeController::class, 'payer_la_commande'])->name('root_site_public_payer_la_commande');

Route::get('validation-commmande/{id}/commande-reçue/type-paiement-{payment}', [PayementController::class, 'commande_recue'])->name('root_site_public_commande_recue');

// Route::get('commande/{id}/type-paiement-{paiement}/facturation', [PayementController::class, 'facture'])->name('root_facture');

Route::post('/newsletter', [HomeController::class, 'newsletter'])->name('root_site_public_newsletter');

Route::post('/place-order', [PayementController::class, 'placeorder'])->name('root_site_public_placeorder');

// paypal

Route::get('create-transaction', [PayementController::class, 'createpaypaltransaction'])->name('root_create_payapl_transaction');

Route::get('process-transaction', [PayementController::class, 'processpaypaltransaction'])->name('root_process_paypal_transaction');

Route::get('success-transaction', [PayementController::class, 'successpaypaltransaction'])->name('root_success_paypal_transaction');

Route::get('cancel-transaction', [PayementController::class, 'cancelpaypaltransaction'])->name('root_cancel_paypal_transaction');

// coupon

Route::post('verification-coupon', [PromotionController::class, 'verification_coupon'])->name('site_public_verification_coupon');

Route::delete('promotion/delete', [PromotionController::class, 'delete'])->name('site_public_delete_promotion');



//Espace Client
Route::middleware('client')->group(function () {

    Route::get('/espace-client', [HomeClientController::class, 'index'])->name('root_espace_client_index')->middleware('client');

    Route::get('/espace-client/commande', [CommandeClientController:: class, 'index'])->name('root_espace_client_commande_index');

    Route ::get('/espace-client/commande/{id}/detail', [CommandeClientController:: class, 'show'])->name('root_espace_client_commande_show');

    // Route::get('/espace-client/commandes/{id}/facturation', [CommandeClientController:: class, 'facture'])->name('root_espace_client_commande_facture');

    Route::get('espace-client/facture/{id}', [PayementController::class, 'facture'])->name('root_facture');

    Route::get('/espace-client/paiement', [PaiementClientController:: class, 'index'])->name('root_espace_client_paiement_index');

    Route::get('/espace-client/page-paiement', [PaiementClientController:: class, 'payer_index'])->name('root_espace_client_payer_index');

    // Route::get('validation/{id}/commande-reçue/type-paiement-{payment}', [PaiementClientController:: class, 'store'])->name('root_espace_client_store');


    // information client
    Route::get('espace-client/information-client', [InformationClientController::class, 'index'])->name('root_espace_client_information_client');

    Route::post('espace-client/information-client/validation', [InformationClientController::class, 'store'])->name('root_espace_client_create_information_client');

    Route::post('espace-client/information-client/update', [InformationClientController::class, 'update'])->name('root_espace_client_update_information_client');

    // favoris

    Route::get('site-public/favoris', [FavorisClientController::class, 'index'])->name('root_site_public_favoris_index');

    Route::delete('site-public/favoris/{id}/supprimer', [FavorisClientController::class, 'delete'])->name('root_site_public_favoris_delete');

});

// end espace client


// Espace admin

Route::middleware('admin')->group(function () {

    Route::get('/espace-admin', [HomeAdminController::class, 'index'])->name('root_espace_admin_index')->middleware('admin');

    Route::get('/verification-auth', [SitepublicController::class, 'verification'])->name('root_verification_auth');

    Route::get('/espace-admin/clients', [ClientAdminController::class, 'index'])->name('root_espace_admin_clients_index');

    Route::delete('espace-admin/clients/supprimer/{id}', [ClientAdminController::class, 'delete'])->name('root_delete_clients');

    Route::get('/espace-admin/clients/{id}/detail', [ClientAdminController::class, 'show'])->name('root_espace_admin_clients_show');

    Route::get('/espace-admin/ajout/clients', [ClientAdminController::class, 'add'])->name('root_espace_admin_clients_add');

    Route::post('/espace-admin/ajout/client', [ClientAdminController::class, 'create'])->name('root_espace_admin_cliens_create');

    // Paiement

    Route::get('espace-admin/paiements', [PaiementAdminController::class, 'index'])->name('root_espace_admin_paiements_index');

    Route::get('espace-admin/paiements/{id}', [PaiementAdminController::class, 'show'])->name('root_espace_admin_paiements_show');

    Route::put('espace-admin/paiement/update', [PaiementAdminController::class, 'edit'])->name('root_espace_admin_edit_paiement');

    Route::delete('espace-admin/paiement/{id}/supprimer', [PaiementAdminController::class, 'delete'])->name('root_espace_admin_delete_paiement');

    // Commandes

    Route::get('espace-admin/commandes', [CommandeAdminController::class, 'index'])->name('root_espace_admin_commandes_index');

    Route::get('espace-admin/paiement/{id}/details', [PaiementAdminController::class, 'detail'])->name('root_espace_admin_detail_ajout_paiement');

    Route::post('espace-admin/paiement/ajouter', [PaiementAdminController::class, 'create'])->name('root_espace_admin_paiement_create');

    Route::post('espace-admin/commande-valider/{id}', [CommandeAdminController::class, 'valider_commande'])->name('root_espace_admin_valider_commande');

    Route::post('espace-admin/commande-annuler/{id}', [CommandeAdminController::class, 'annuler_commande'])->name('root_espace_admin_annuler_commande');

    Route::post('espace-admin/commande-mise-en-attente/{id}', [CommandeAdminController::class, 'en_attente__commande'])->name('root_espace_admin_en_attente_commande');

    Route::delete('espace-admin/commande/{id}/supprimer', [CommandeAdminController::class, 'delete_commande'])->name('root_espace_admin_delete_commande');

    Route::get('espace-admin/commandes/{id}/show', [CommandeAdminController::class, 'show'])->name('root_espace_admin_commandes_show');

    // gestion users

    Route::get('espace-admin/utilisateurs', [UserController::class, 'index_utilisateur'])->name('root_espace_admin_index_utilisateur');

    Route::put('espace-admin/utilisateur/update', [UserController::class, 'edit_utilisateur'])->name('root_espace_admin_edit_utilisateur');

    Route::delete('espace-admin/utilisateur/{id}/supprimer', [UserController::class, 'delete'])->name('root_espace_admin_delete_utilisateur');

    // gestion newslette
    Route::get('espace-admin/client/newsletter', [HomeAdminController::class, 'news'])->name('root_espace_admin_commandes_news');

    Route::get('espace-admin/newsletter/{id}/bloquer', [HomeAdminController::class, 'bloquer'])->name('root_espace_admin_bloquer_newsletter');

    Route::get('espace-admin/newsletter/{id}/debloquer', [HomeAdminController::class, 'debloquer'])->name('root_espace_admin_debloquer_newsletter');

    Route::delete('espace-admin/newsletter/{id}/supprimer', [HomeAdminController::class, 'delete'])->name('root_espace_admin_newsletter_delete');


    // gestion categorie

    Route::get('espace-admin/categories', [CategorieController::class, 'index'])->name('root_espace_admin_index_categorie');

    Route::get('espace-admin/categories/{id}/details', [CategorieController::class, 'show'])->name('root_espace_admin_details_categorie');

    Route::put('espace-admin/categorie/update', [CategorieController::class, 'update'])->name('root_espace_admin_edit');

    Route::delete('espace-admin/categorie/{id}/supprimer', [CategorieController::class, 'delete'])->name('root_espace_admin_delete_categorie');

    Route::post('espace-admin/categorie/Ajouter', [CategorieController::class, 'store'])->name('root_espace_admin_store');

    // gestion livraison

    Route::get('espace-admin/livraisons', [LivraisonController::class, 'index'])->name('root_espace_admin_index_livraison');

    Route::get('espace-admin/livraisons/{id}/detail', [LivraisonController::class, 'details'])->name('root_espace_admin_details');

    Route::delete('espace-admin/livraisons/{id}/delete', [LivraisonController::class, 'delete_livraison'])->name('root_espace_admin_delete_livraisons');

    Route::post('espace-admin/livraisons/{id}/modification-statut', [LivraisonController::class, 'modification_statut'])->name('root_espace_admin_modification_statut_livraison');

    Route::put('espace-admin/livraisons/update-expedition', [LivraisonController::class, 'update_frais'])->name('root_espace_admin_livraison_update');


    // gestion Expédition

    Route::get('espace-admin/expedition', [LivraisonController::class, 'index_expedition'])->name('root_espace_admin_index_expedition');

    Route::post('espace-admin/expedition/store', [LivraisonController::class, 'store'])->name('root_espace_admin_store_expedition');

    Route::put('espace-admin/expedition/update', [LivraisonController::class, 'update'])->name('root_espace_admin_update_expedition');

    Route::delete('espace-admin/expedition/{id}/delete', [LivraisonController::class, 'delete'])->name('root_espace_admin_delete_expedition');



    // gestion sous-categorie

    Route::get('espace-admin/sous-categories', [SousCategorieAdminController::class, 'index_sous_categorie'])->name('root_espace_admin_index_sous_categorie');

    Route::put('espace-admin/sous-categorie/update', [SousCategorieAdminController::class, 'Update'])->name('root_espace_admin_edit_sous_categorie');

    Route::post('espace-admin/sous-categorie/ajouter', [SousCategorieAdminController::class, 'create'])->name('root_espace_admin_create_sous_categorie');

    Route::delete('espace-admin/sous-categorie/{id}/supprimer', [SousCategorieAdminController::class, 'delete'])->name('root_espace_admin_delete_sous_categorie');

    Route::get('espace-admin/sous-categorie/{id}/details', [SousCategorieAdminController::class, 'show'])->name('root_espace_admin_details_sous_categorie');


    // gestion Produits

    Route::get('espace-admin/produits', [ProduitAdminController::class, 'index'])->name('root_espace_admin_index_produit');

    Route::get('espace-admin/produits/{id}/modifier', [ProduitAdminController::class, 'edit'])->name('root_espace_admin_modifie_vue');

    Route::put('espace-admin/produits/{id}/update', [ProduitAdminController::class, 'update'])->name('root_espace_admin_modifie_produit');

    Route::put('espace-admin/produits/update-image', [ProduitAdminController::class, 'update_image'])->name('root_espace_admin_modifie_image_produit');

    Route::get('espace-admin/produits/ajouter', [ProduitAdminController::class, 'add_vue'])->name('root_espace_admin_add_vue');

    Route::post('espace-admin/produits/store', [ProduitAdminController::class, 'store'])->name('root_espace_admin_produit_create');

    Route::delete('espace-admin/produits/{id}/supprimer', [ProduitAdminController::class, 'delete'])->name('root_espace_admin_produit_delete');

    Route::get('espace-admin/produits/{id}/show', [ProduitAdminController::class, 'show'])->name('root_espace_admin_show_produit');


    //images

    Route::get('espace-admin/images', [ProduitAdminController::class, 'index_images'])->name('root_espace_admin_images');

    Route::get('espace-admin/produits/{id}/show-images', [ProduitAdminController::class, 'show_images'])->name('root_espace_admin_show_images');


    // gestion partenaire

    Route::get('espace-admin/partenaires', [PartenaireAdminController::class, 'index'])->name('root_espace_admin_index_partenaire');

    Route::put('espace-admin/partenaires/update', [PartenaireAdminController::class, 'update'])->name('root_espace_admin_edit_partenaire');

    Route::put('espace-admin/partenaires/update-image', [PartenaireAdminController::class, 'update_image'])->name('root_espace_admin_edit_image_partenaire');

    Route::post('espace-admin/partenaires/ajouter', [PartenaireAdminController::class, 'store'])->name('root_espace_admin_partenaire_create');

    Route::delete('espace-admin/partenaires/{id}/supprimer', [PartenaireAdminController::class, 'delete'])->name('root_espace_admin_partenaire_delete');

    // gestion stock

    Route::get('espace-admin/stocks', [StockAdminController::class, 'index'])->name('root_espace_admin_index_stock');

    Route::get('espace-admin/stock/ajouter', [StockAdminController::class, 'create'])->name('root_espace_admin_create_stock');

    Route::post('espace-admin/stock/store', [StockAdminController::class, 'store'])->name('root_espace_admin_stock_create');

    Route::put('espace-admin/stock/update', [StockAdminController::class, 'update'])->name('root_espace_admin_edit_stock');

    Route::delete('espace-admin/stock/{id}/supprimer', [StockAdminController::class, 'delete'])->name('root_espace_admin_delete_stock');

    // correction stock

    Route::get('espace-admin/stocks/correction-stock', [StockAdminController::class, 'index_correction'])->name('root_espace_admin_index_correction');

    Route::put('espace-admin/stocks/correction-stock/update', [StockAdminController::class, 'edit_correction'])->name('root_espace_admin_edit_correction');


    // Image associé à un produit

    Route::post('espace-admin/images/produits', [ProduitAdminController::class, 'create_image'])->name('root_espace_admin_create_image_produit');

    Route::get('espace-admin/images', [ProduitAdminController::class, 'index_image'])->name('root_espace_admin_images');

    Route::post('espbace-admin/images/update', [ProduitAdminController::class, 'update_image'])->name('root_espace_admin_update_images');

    Route::delete('espace-admin/images/supprimer', [ProduitAdminController::class, 'delete_image'])->name('root_espace_admin_delete_images');

    // promotion admin

    Route::get('espace-admin/promotions', [PromotionAdminController::class, 'index'])->name('root_espace_admin_index_promotion');

    Route::post('espace-admin/promotions/ajouter', [PromotionAdminController::class, 'store'])->name('root_espace_admin_promotion_ajouter');

    Route::put('espace-admin/promotions/update', [PromotionAdminController::class, 'update'])->name('root_espace_admin_promotion_update');

    Route::delete('espace-admin/promotions/delete', [PromotionAdminController::class, 'delete'])->name('root_espace_admin_promotion_delete');

    // publicites

    Route::get('espace-admin/publicites', [PubliciteAdminController::class, 'index'])->name('root_espace_admin_publicites');

    Route::post('espace-admin/publicites/ajouter', [PubliciteAdminController::class, 'store'])->name('root_espace_admin_ajouter_publicites');

    Route::put('espace-admin/publicites/update', [PubliciteAdminController::class, 'update'])->name('root_espace_admin_modifier_publicites');

    Route::put('espace-admin/publicites/update-image', [PubliciteAdminController::class, 'update_image'])->name('root_espace_admin_modifier_image_publicites');

    Route::delete('espace-admin/publicites/{id}/publicites', [PubliciteAdminController::class, 'delete'])->name('root_espace_admin_supprimer_publicites');

    Route::get('site-public/publicites', [PubliciteAdminController::class, 'index'])->name('root_site_public_publicite_index');

    // produit non livré

    Route::get('espace-admin/produits-non-livre', [ProduitNonLivrerAdminContoller::class, 'index'])->name('root_espace_admin_produits_non_livrer');

    Route::get('espace-admin/produits-non-livre/{id}/modifier', [ProduitNonLivrerAdminContoller::class, 'validation_produit_livre'])->name('root_espace_admin_modifie_produits_non_livre');

    Route::post('espace-admin/produits-non-livre/{id}/retirer', [ProduitNonLivrerAdminContoller::class, 'validation_produit_non_livre'])->name('root_espace_admin_retirer_produits_non_livre');

    // generation facture

    Route::get('espace-admin/livraison/{id}/facture-generate/', [FactureController::class, 'index'])->name('root_espace_admin_index_facture');

    Route::post('espace-admin/livraison/facture', [FactureController::class, 'store_facture_item'])->name('root_espace_admin_creation_facture');

    Route::post('espace-admin/generate/facture', [FactureController::class, 'store_facture'])->name('root_espace_admin_generate_facture');

    Route::get('espace-admin/livraison/facture/{id}', [FactureController::class, 'facture'])->name('root_espace_admin_facture');

    Route::put('espace-admin/livraison/facture/update', [FactureController::class, 'update'])->name('root_espace_admin_facture_update');

    Route::post('espace-admin/livraison/validation/facture/{id}', [FactureController::class, 'confirm'])->name('root_espace_admin_facture_validate');


});
// end espace admin


// end espace Gestionnaire


// espace Comptable
Route::middleware('comptable')->group(function () {

    Route::get('/espace-admin', [HomeAdminController::class, 'index'])->name('root_espace_admin_index');

    // gestion de vente les commandes

    Route::get('espace-admin/recapitulatif-vente', [RecapitutatifController::class, 'index'])->name('root_espace_admin_recapitutatif_index');

    Route::post('espace-admin/recapitulatif-vente', [RecapitutatifController::class, 'show'])->name('root_espace_admin_recapitutatif_show');

    // gestion bilan de vente les paiements

    Route::get('espace-admin/recapitulatif-paiements', [RecapitutatifController::class, 'index_paiement'])->name('root_espace_admin_recapitutatif_paiement_index');

    Route::post('espace-admin/recapitulatif-paiements', [RecapitutatifController::class, 'show_paiement'])->name('root_espace_admin_recapitutatif_paiement_show');


});
// end espace Comptable

Route::get('/tableau', function() {
    return view('espace-client/gestion');
})->name('root_espace_client_gestion');

// End espace AdresseClient

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
    ])->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');
    });


Route::get('se-connecter', [UserController::class, 'connexion'])->name('root_auth_login')->middleware("guest");
Route::get('s-inscrire', [UserController::class, 'inscription'])->name('root_auth_register')->middleware("guest");
Route::get('se-deconnecter', [UserController::class, 'deconnexion'])->name('root_deconnexion');

