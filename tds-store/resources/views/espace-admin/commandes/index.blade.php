@extends('layouts.master-dashboard')

@section('admin-commandes')
@include('layouts.partials-dashboard.entête-page', [
    'infos1' => 'Commandes',
    'infos2' => 'Commandes',
    'infos3' => 'Toutes les Commandes',
])
<br>
<div class="row">
    <div class="col-md-12 col-12">
        <div class="card m-b-30">
            <div class="card-header bg-success">
                <h4 class="mt-0 header-title text-white" style="font-size: 24px; text-align: center;">Toutes les commandes terminée</h4>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; {{ couleur_principal() }}">
                    <thead>
                    <tr>
                        <th>N°</th>
                        <th>Id</th>
                        <th>Date</th>
                        <th>Nom & Prénom client</th>
                        <th>Montant</th>
                        <th>Status</th>
                        <th style="width: 10%">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @php
                            $y= 1;
                        @endphp
                        @foreach ($commandes_terminee  as $cmd_terminee)

                        <tr>
                            <td>{{ $y}}</td>
                            <td>{{ $cmd_terminee->id }}</td>
                            <td>{{ $cmd_terminee->created_at }}</td>
                            <td>{{ $cmd_terminee->adresse_client->nom }} {{ $cmd_terminee->adresse_client->prenom }}</td>
                            <td>{{ number_format ((montant_ttc(montant_apres_reduction_sans_session(total_commande($cmd_terminee->id), $cmd_terminee->promotion), $cmd_terminee->adresse_livraison_id) + verify_amount_livraison_exist(info_livraison($cmd_terminee->id))), 0, '.', ' ') }} F CFA</td>
                            <td>{{ $cmd_terminee->status}}</td>
                            <td>
                            <a href="{{ route('root_espace_admin_commandes_show', $cmd_terminee->id) }}">
                                <button data-toggle="tooltip" title="Voir" class="btn" style="background-color: #007bff; border: #007bff; color: white;"><i class="fa fa-eye"></i></button>
                            </a>
                            <a href="{{ route('root_espace_admin_detail_ajout_paiement', $cmd_terminee->id) }}">
                            <button   data-toggle="tooltip" title="Ajouter paiement" class="btn btn-primary"><i class="fa fa-plus"></i></button>
                            </a>
                            </td>
                            @php
                            $y++;
                            @endphp
                        @endforeach
                        </tr>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
 <div class="row">
    <div class="col-md-12 col-12">
        <div class="card m-b-30">
            <div class="card-header bg-success">
                <h4 class="mt-0 header-title text-white" style="font-size: 24px; text-align: center;">Toutes les commandes en attente de paiement</h4>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                <table id="datatable1" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; {{ couleur_principal() }}">
                    <thead>
                    <tr>
                        <th>N°</th>
                        <th>Id</th>
                        <th>Date</th>
                        <th>Nom & Prénom client</th>
                       <th>Montant</th>
                        <th>Status</th>
                        <th style="width: 10%">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @php
                            $y= 1;
                        @endphp
                        @foreach ($commandes_effectuee  as $cmd_effectuee)

                        <tr>
                            <td>{{ $y}}</td>
                            <td>{{ $cmd_effectuee->id }}</td>
                            <td>{{ $cmd_effectuee->created_at }}</td>
                            <td>{{ $cmd_effectuee->adresse_client->nom }} {{ $cmd_effectuee->adresse_client->prenom }}</td>
                            <td>{{ number_format((montant_ttc(montant_apres_reduction_sans_session(total_commande($cmd_effectuee->id), $cmd_effectuee->promotion), $cmd_effectuee->adresse_livraison_id) + verify_amount_livraison_exist(info_livraison($cmd_effectuee->id))), 0, '.', ' ') }} F CFA</td>
                            <td>{{ $cmd_effectuee->status }}</td>
                            <td>
                            <a href="{{ route('root_espace_admin_commandes_show', $cmd_effectuee->id) }}">
                                <button data-toggle="tooltip" title="Voir" class="btn" style="background-color: #007bff; border: #007bff; color: white;"><i class="fa fa-eye"></i></button>
                            </a>
                            <a href="{{ route('root_espace_admin_detail_ajout_paiement', $cmd_effectuee->id) }}">
                            <button   data-toggle="tooltip" title="Ajouter paiement" class="btn btn-primary"><i class="fa fa-plus"></i></button>
                            </a>
                            </td>
                            @php
                            $y++;
                            @endphp
                        @endforeach
                        </tr>

                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
<br>

<div class="row">
    <div class="col-md-12 col-12">
        <div class="card m-b-30">
            <div class="card-header bg-success">
                <h4 class="mt-0 header-title text-white" style="font-size: 24px; text-align: center;">Toutes les commandes en cours</h4>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                <table id="datatable2" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; {{ couleur_principal() }}">
                    <thead>
                    <tr>
                        <th>N°</th>
                        <th>Id</th>
                        <th>Date</th>
                        <th>Nom & Prénom client</th>
                        <th>Montant</th>
                        <th>Status</th>
                        <th style="width: 10%">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @php
                            $y= 1;
                        @endphp
                        @foreach ($commandes_en_attente as $cmde_en_attente)

                        <tr>
                            <td>{{ $y}}</td>
                            <td>{{ $cmde_en_attente->id }}</td>
                            <td>{{ $cmde_en_attente->created_at }}</td>
                            <td>{{ $cmde_en_attente->adresse_client->nom }} {{ $cmde_en_attente->adresse_client->prenom }}</td>
                            <td>{{ number_format ((montant_ttc(montant_apres_reduction_sans_session(total_commande($cmde_en_attente->id), $cmde_en_attente->promotion), $cmde_en_attente->adresse_livraison_id) + verify_amount_livraison_exist(info_livraison($cmde_en_attente->id))), 0, '.', ' ') }} F CFA</td>
                            <td>{{$cmde_en_attente->status}}</td>
                            <td>
                            <a href="{{ route('root_espace_admin_commandes_show', $cmde_en_attente->id) }}">
                                <button data-toggle="tooltip" title="Voir" class="btn" style="background-color: #007bff; border: #007bff; color: white;"><i class="fa fa-eye"></i></button>
                            </a>
                            <a href="{{ route('root_espace_admin_detail_ajout_paiement', $cmde_en_attente->id) }}">
                                <button data-toggle="tooltip" title="Ajouter paiement" class="btn btn-primary"><i class="fa fa-plus"></i></button>
                                </a>
                            </td>
                        </tr>
                        @php
                            $y++;
                            @endphp
                        @endforeach

                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
<br>

<div class="row">
    <div class="col-md-12 col-12">
        <div class="card m-b-30">
            <div class="card-header bg-success">
                <h4 class="mt-0 header-title text-white" style="font-size: 24px; text-align: center;">Toutes les commandes non payées</h4>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                <table id="datatable3" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; {{ couleur_principal() }}">
                    <thead>
                    <tr>
                        <th>N°</th>
                        <th>Id</th>
                        <th>Date</th>
                        <th>Nom & Prénom client</th>
                        <th>Montant</th>
                        <th>Status</th>
                        <th style="width: 10%">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @php
                            $y= 1;
                        @endphp
                        @foreach ($commandes_non_payee  as $cmde_non_payee)

                        <tr>
                            <td>{{ $y}}</td>
                            <td>{{ $cmde_non_payee->id }}</td>
                            <td>{{ $cmde_non_payee->created_at }}</td>
                            <td>{{ $cmde_non_payee->adresse_client->nom }} {{ $cmde_non_payee->adresse_client->prenom }}</td>
                            <td>{{ number_format ((montant_ttc(montant_apres_reduction_sans_session(total_commande($cmde_non_payee->id), $cmde_non_payee->promotion), $cmde_non_payee->adresse_livraison_id) + verify_amount_livraison_exist(info_livraison($cmde_non_payee->id))), 0, '.', ' ') }} F CFA</td>
                            <td>{{$cmde_non_payee->status}}</td>
                            <td>
                            <a href="{{ route('root_espace_admin_commandes_show', $cmde_non_payee->id) }}">
                                <button  data-toggle="tooltip" title="Voir" class="btn" style="background-color: #007bff; border: #007bff; color: white;"><i class="fa fa-eye"></i></button>
                            </a>
                            <a href="{{ route('root_espace_admin_detail_ajout_paiement', $cmde_non_payee->id) }}">
                                <button  data-toggle="tooltip" title="Ajouter paiement" class="btn btn-primary"><i class="fa fa-plus"></i></button>
                                </a>
                            </td>
                        </tr>
                        @php
                            $y++;
                            @endphp
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
<br>

<div class="row">
    <div class="col-md-12 col-12">
        <div class="card m-b-30">
            <div class="card-header bg-success">
                <h4 class="mt-0 header-title text-white" style="font-size: 24px; text-align: center;">Toutes les commandes annulées</h4>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                <table id="datatable4" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; {{ couleur_principal() }}">
                    <thead>
                    <tr>
                        <th>N°</th>
                        <th>Id</th>
                        <th>Date</th>
                        <th>Nom & Prénom client</th>
                        <th>Montant</th>
                        <th>Status</th>
                        <th style="width: 10%">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @php
                            $y= 1;
                        @endphp
                        @foreach ($commandes_annulee  as $cmde_annulee)

                        <tr>
                            <td>{{ $y}}</td>
                            <td>{{ $cmde_annulee->id }}</td>
                            <td>{{ $cmde_annulee->created_at }}</td>
                            <td>{{ $cmde_annulee->adresse_client->nom }} {{ $cmde_annulee->adresse_client->prenom }}</td>
                            <td>{{ number_format ((montant_ttc(montant_apres_reduction_sans_session(total_commande($cmde_annulee->id), $cmde_annulee->promotion), $cmde_annulee->adresse_livraison_id) + verify_amount_livraison_exist(info_livraison($cmde_annulee->id))), 0, '.', ' ') }} F CFA</td>
                            <td>{{$cmde_annulee->status}}</td>
                            <td>
                            <a href="{{ route('root_espace_admin_commandes_show', $cmde_annulee->id) }}">
                                <button data-toggle="tooltip" title="Voir" class="btn" style="background-color: #007bff; border: #007bff; color: white;"><i class="fa fa-eye"></i></button>
                            </a>
                            </td>
                        </tr>
                        @php
                            $y++;
                            @endphp
                        @endforeach

                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function() {
        $('#datatable1').DataTable();
    });
    $(document).ready(function() {
        $('#datatable2').DataTable();
    });
    $(document).ready(function() {
        $('#datatable3').DataTable();
    });
    $(document).ready(function() {
        $('#datatable4').DataTable();
    });
</script>
@endsection
