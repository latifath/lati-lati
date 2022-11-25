@extends('layouts.master-dashboard')

@section('contenu-client')
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
                    <span class="badge badge-success">{{ $nb_cmd_effectuee }}</span><span class="ml-2 text-muted">Commande terminée</span><br>
                    <span class="badge badge-success">{{ $nb_cmd_attente }}</span><span class="ml-2 text-muted">Commande en cours</span><br>
                    <span class="badge badge-success">{{ $nb_cmd_annulee }}</span><span class="ml-2 text-muted">Commande annulée</span><br>
                    <span class="badge badge-success">{{ $nb_cmd_non_payee }}</span><span class="ml-2 text-muted">Commande non payée</span><br>
                </div>
                <div class="mt-4 text-muted">
                    <h5 class="m-0">{{ $nb_cmd_effectuee + $nb_cmd_attente + $nb_cmd_annulee + $nb_cmd_non_payee }}<i class="mdi mdi-arrow-up text-success ml-2"></i>Total</h5>

                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card mini-stat m-b-30">
            <div class="p-3 bg-primary text-white">
                <div class="mini-stat-icon">
                    <i class="mdi mdi-account-network float-right mb-0"></i>
                </div>
                <h6 class="text-uppercase mb-0"> Dernier paiement</h6>
            </div>
            <div class="card-body">
                <div class="border-bottom pb-4">
                     {{-- <span class="badge badge-success">{{ $paiement == " " ? '0' : number_format((montant_ttc(montant_apres_reduction_sans_session ($paiement->montant,  $commande->promotion), $commande->adresse_livraison_id) + verify_amount_livraison_exist(info_livraison($commande->id))), '0', '.', ' ' ) }} F CFA</span> <span class="ml-2 text-muted">Dernier paiement</span> --}}
                </div>
                <div class="mt-4 text-muted">
                    {{-- <h5 class="m-0" style="color: #ea0513;">{{ $paiement == " " ? '0' : number_format((montant_ttc(montant_apres_reduction_sans_session ($paiement->montant,  $commande->promotion), $commande->adresse_livraison_id) + verify_amount_livraison_exist(info_livraison($commande->id))), '0','.', ' ' ) }} F CFA<i class="mdi mdi-arrow-up text-success ml-2"></i></h5> --}}
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card mini-stat m-b-30">
            <div class="p-3 bg-primary text-white">
                <div class="mini-stat-icon">
                    <i class="mdi mdi-tag-text-outline float-right mb-0"></i>
                </div>
                <h6 class="text-uppercase mb-0">Livraison</h6>
            </div>
            <div class="card-body">
                <div class="border-bottom pb-4">
                    <span class="badge badge-danger"> -02% </span> <span class="ml-2 text-muted">From previous period</span>
                </div>
                <div class="mt-4 text-muted">
                    <h5 class="m-0">14.5<i class="mdi mdi-arrow-down text-danger ml-2"></i></h5>

                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card mini-stat m-b-30">
            <div class="p-3 bg-primary text-white">
                <div class="mini-stat-icon">
                <i class="mdi mdi-cube-outline float-right mb-0"></i>
                </div>
                <h6 class="text-uppercase mb-0">Suivi produit</h6>
            </div>
            <div class="card-body">
                <div class="border-bottom pb-4">
                    <span class="badge badge-success"> +10% </span> <span class="ml-2 text-muted">From previous period</span>
                </div>
                <div class="mt-4 text-muted">
                    <h5 class="m-0">15234<i class="mdi mdi-arrow-up text-success ml-2"></i></h5>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
