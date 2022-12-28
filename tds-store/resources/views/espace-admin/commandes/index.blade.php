@extends('layouts.master-dashboard')

@section('admin-commandes')
@include('layouts.partials-dashboard.entête-page', [
    'infos1' => 'Commandes',
    'infos2' => 'Commandes',
    'infos3' => 'Toutes les Commandes',
])
<br>

<div class="">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="terminee-tab" data-toggle="tab" href="#terminee" role="tab" aria-controls="terminee" aria-selected="true">Terminée</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="encours-tab" data-toggle="tab" href="#encours" role="tab" aria-controls="encours" aria-selected="false">En cours</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="non-payee-tab" data-toggle="tab" href="#non-payee" role="tab" aria-controls="non-payee" aria-selected="false">Non payee</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="attente-paiement-tab" data-toggle="tab" href="#attente-paiement" role="tab" aria-controls="attente-paiement" aria-selected="false">En attente de paiement</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="annulee-tab" data-toggle="tab" href="#annulee" role="tab" aria-controls="annulee" aria-selected="false">Annulée</a>
        </li>
    </ul>

    <div class="tab-content bg-white" id="myTabContent">
        <div class="tab-pane fade show active" id="terminee" role="tabpanel" aria-labelledby="terminee-tab">
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
                            @foreach ($commandes_terminee  as $key => $cmd_terminee)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
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
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="encours" role="tabpanel" aria-labelledby="encours-tab">
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
                            @foreach ($commandes_en_attente as $key => $cmde_en_attente)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
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
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="non-payee" role="tabpanel" aria-labelledby="non-payee-tab">
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
                            @foreach ($commandes_non_payee  as $key => $cmde_non_payee)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
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
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="attente-paiement" role="tabpanel" aria-labelledby="attente-paiement-tab">
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
                            @foreach ($commandes_effectuee  as $key => $cmd_effectuee)

                            <tr>
                                <td>{{ $key + 1 }}</td>
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
                            @endforeach
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="annulee" role="tabpanel" aria-labelledby="annulee-tab">
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
                            @foreach ($commandes_annulee  as $cmde_annulee)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
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
