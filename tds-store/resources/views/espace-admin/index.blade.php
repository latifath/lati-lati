@extends('layouts.master-dashboard')
@section('contenu-admin')
@include('layouts.partials-dashboard.entête-page', [
    'infos1' => 'Tableau de bord',
    'infos2' => 'TDS Store',
    'infos3' => 'Historique',
])
<br>

<div class="row">
    <div class="col-xl-3 col-md-6">
        <div class="card mini-stat m-b-30">
            <div class="p-3 bg-primary text-white">
                <div class="mini-stat-icon">
                    <i class="mdi mdi-cart-outline float-right mb-0"></i>
                </div>
                <h6 class="text-uppercase mb-0" >Commande</h6>
            </div>
            <div class="card-body">
                <div class="border-bottom pb-4">
                    <span class="badge badge-success">{{ $commandes_effectuee -> count() }}</span><span class="ml-2 text-muted">Commande effectuée</span><br>
                    <span class="badge badge-success">{{  $commandes_en_attente ->count() }}</span><span class="ml-2 text-muted">Commande en cours</span><br>
                    <span class="badge badge-success">{{ $commandes_annulee ->count() }}</span><span class="ml-2 text-muted">Commande annulée</span><br>
                    <span class="badge badge-success">{{ $commandes_non_payee ->count() }}</span><span class="ml-2 text-muted">Commande non payée</span><br>
                </div>
                <div class="mt-4 text-muted">
                    <h5 class="m-0" style="{{ couleur_text_2() }}">{{ $commandes_effectuee -> count() + $commandes_en_attente ->count()  + $commandes_annulee ->count() + $commandes_non_payee ->count()}}<i class="mdi mdi-arrow-up text-success ml-2"></i>Total</h5>

                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card mini-stat m-b-30">
            <div class="p-3 bg-primary text-white">
                <div class="mini-stat-icon">
                    <i class="fa fa-product-hunt  float-right mb-0"></i>
                </div>
                <h6 class="text-uppercase mb-0" >Produits</h6>
            </div>
            <div class="card-body">
                <div class="border-bottom pb-4">
                    <span class="badge badge-success">{{ $categories ->count()}}</span><span class="ml-2 text-muted">Catégories</span><br>
                    <span class="badge badge-success">{{ $sous_categories ->count() }}</span><span class="ml-2 text-muted">Sous-catégories</span><br>
                </div>
                <div class="mt-4 text-muted">
                    <h5 class="m-0" style="{{ couleur_text_2() }}">{{ $produits ->count()}}<i class="mdi mdi-arrow-up text-success ml-2"></i>Total Produits</h5>
                </div>
            </div>
        </div>
    </div>

<div class="col-xl-3 col-md-6">
    <div class="card mini-stat m-b-30">
        <div class="p-3 bg-primary text-white">
            <div class="mini-stat-icon">
                <i class="fa fa-user float-right mb-0"></i>
            </div>
            <h6 class="text-uppercase mb-0" >Utilisateur</h6>
        </div>
        <div class="card-body">
            <div class="border-bottom pb-4">
                <span class="badge badge-success">{{ $nbr_role_client ->count()}}</span><span class="ml-2 text-muted">Client</span><br>
                <span class="badge badge-success">{{ $nbr_role_admin ->count() }}</span><span class="ml-2 text-muted">Admin</span><br>
            </div>
            <div class="mt-4 text-muted">
                <h5 class="m-0" style="{{ couleur_text_2() }}">{{ $nbr_role_admin->count() +  $nbr_role_client->count()}}<i class="mdi mdi-arrow-up text-success ml-2"></i>Total</h5>

            </div>
        </div>
    </div>
</div>

<div class="col-xl-3 col-md-6">
    <div class="card mini-stat m-b-30">
        <div class="p-3 bg-primary text-white">
            <div class="mini-stat-icon">
                <i class="fa fa-money float-right mb-0"></i>
            </div>
            <h6 class="text-uppercase mb-0">Paiements</h6>
        </div>
        <div class="card-body">
            <div class="border-bottom pb-4">
                <span class="badge badge-success">{{ number_format($m_paiement, '0', '.', ' ') }} F CFA</span><span class="ml-2 text-muted">Paiement</span><br>
            </div>
            <div class="mt-4 text-muted">
                <h5 class="m-0" style="{{ couleur_text_2() }}">{{ number_format($m_paiement, '0', '.', ' ') }} F CFA<i class="mdi mdi-arrow-up text-success ml-2"></i>Total</h5>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')

@endsection
