@extends('layouts.master-dashboard')
@section('contenu-commande')

@include('layouts.partials-dashboard.entête-page', [
    'infos1' => 'Commandes',
    'infos2' => 'Commandes',
    'infos3' => 'Toutes les commandes',
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
                            <th>Date</th>
                            <th>Montant</th>
                            <th>Type de paiement</th>
                            <th style="width: 8%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @php
                                $i= 1;
                            @endphp
                            @foreach($list_commandes_effectuee as $item)

                            <tr>
                                <td>{{ $item->id}}</td>
                                <td>{{ $item->created_at}}</td>
                                <td>{{ number_format(account_commande($item->id)->montant, 0, '.', ' ')}} F CFA</td>
                                <td>{{ $item->type_paiement}}</td>
                                <td>
                                    <a href="{{ route('root_espace_client_commande_show', $item->id) }}">
                                        <button class="btn" style="background-color: #007bff; border: #007bff; color: white;"><i class="fa fa-eye" aria-hidden="true"></i> Voir</button>

                                    </a>
                                    <a href="{{ route('root_espace_client_commande_facture', $item->id) }}">

                                        <button class="btn btn-primary"><i class="fa fa-eye" aria-hidden="true"></i> Facture</button>
                                    </a>
                                </td>
                            </tr>
                            @php
                                $i++;
                            @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="encours" role="tabpanel" aria-labelledby="encours-tab">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable1" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; {{ couleur_principal() }}">
                        <thead>
                        <tr>
                            <th>N°</th>
                            <th>Date</th>
                            <th>Montant</th>
                            <th>Type de paiement</th>
                            <th style="width: 8%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @php
                                $i =1;
                            @endphp
                            @foreach($list_commandes_en_attente as $item)

                            <tr>
                                <td>{{ $i}}</td>
                                <td>{{ $item->created_at}}</td>
                                <td>{{ account_commande($item->id) ? number_format(account_commande($item->id)->montant, '0', '.', ' ' ) .' F CFA' : 'Néant' }}</td>
                                <td>{{ account_commande($item->id) ?  account_commande($item->id)->type_paiement : 'Néant' }}</td>
                                <td>
                                    <a href="{{ route('root_espace_client_commande_show', $item->id) }}">
                                        <button class="btn" style="background-color: #007bff; border: #007bff; color: white;"><i class="fa fa-eye" aria-hidden="true"></i> Voir</button>
                                    </a>

                                    <a href="{{ route('root_espace_client_commande_facture', $item->id) }}">
                                        <button class="btn btn-primary"><i class="fa fa-eye" aria-hidden="true"></i> Facture</button>
                                    </a>
                                </td>


                            </tr>
                            @php
                                $i++;
                            @endphp
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="non-payee" role="tabpanel" aria-labelledby="non-payee-tab">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable2" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; {{ couleur_principal() }};">
                        <thead>
                        <tr>
                            <th>N°</th>
                            <th>Date</th>
                            <th>Montant</th>
                            <th>Type de paiement</th>
                            <th style="width: 5%;">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach($list_commandes_non_payee  as $item)

                            <tr>
                                <td>{{ $i}}</td>
                                <td>{{ $item->created_at}}</td>
                                <td>{{ number_format ((montant_ttc(montant_apres_reduction_sans_session(total_commande($item->id), $item->promotion), $item->adresse_livraison_id) + valeur_expedition($item->id)->montant), 0, '.', ' ') }} F CFA</td>
                                <td>{{ account_commande($item->id) ? account_commande($item->id)->type_paiement : 'Néant'}}</td>
                                <td>
                                    <a href="{{ route('root_espace_client_commande_show', $item->id) }}">
                                        <button class="btn" style="background-color: #007bff; border: #007bff; color: white;" ><i class="fa fa-eye" aria-hidden="true"></i> Voir</button>
                                    </a>

                                    <a href="{{ route('root_espace_client_commande_facture', $item->id) }}">
                                        <button class="btn btn-primary"><i class="fa fa-eye" aria-hidden="true"></i> Facture</button>
                                    </a>
                                </td>
                            </tr>
                            @php
                                $i++;
                            @endphp
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="attente-paiement" role="tabpanel" aria-labelledby="attente-paiement-tab">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable3" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; {{ couleur_principal() }};">
                        <thead>
                        <tr>
                            <th>N°</th>
                            <th>Date</th>
                            <th>Montant</th>
                            <th>Type de paiement</th>
                            <th style="width: 8%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach($list_commandes_attente_paiement  as $item)

                            <tr>
                                <td>{{ $i}}</td>
                                <td>{{ $item->created_at}}</td>
                                <td>{{ number_format(montant_ttc(montant_apres_reduction_sans_session(total_commande($item->id), $item->promotion), $item->adresse_livraison_id),  0, '.', ' ' ) }} F CFA</td>
                                <td>Néant</td>
                                <td>
                                    <a href="{{ route('root_espace_client_commande_show', $item->id) }}">
                                        <button class="btn" style="background-color: #007bff; border: #007bff; color: white;" ><i class="fa fa-eye" aria-hidden="true"></i> Voir</button>
                                    </a>
                                    <a href="{{ route('root_espace_client_commande_facture', $item->id) }}">

                                        <button class="btn btn-primary"><i class="fa fa-eye" aria-hidden="true"></i> Facture</button>
                                    </a>
                                </td>
                            </tr>
                            @php
                                $i++;
                            @endphp
                        @endforeach
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
                            <th>Date</th>
                            <th>Montant</th>
                            <th>Type de paiement</th>
                            <th style="width: 8%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @php
                                $i= 1;
                            @endphp
                            @foreach($list_commandes_annulee as $item)

                            <tr>
                                <td>{{ $i}}</td>
                                <td>{{ $item->created_at}}</td>
                                <td>{{ number_format((montant_ttc(montant_apres_reduction_sans_session(total_commande($item->id), $item->promotion), $item->adresse_livraison_id) + valeur_expedition($item->id)->montant),  0, '.', ' ' )}}</td>
                                <td>{{ account_commande($item->id) ? account_commande($item->id)->type_paiement : ' '}}</td>
                                <td>
                                    <a href="{{ route('root_espace_client_commande_show', $item->id) }}">
                                        <button class="btn" style="background-color: #007bff; border: #007bff; color: white;"><i class="fa fa-eye" aria-hidden="true"></i> Voir</button>
                                    </a>

                                    <a href="{{ route('root_espace_client_commande_facture', $item->id) }}">
                                        <button class="btn btn-primary"><i class="fa fa-eye" aria-hidden="true"></i> Facture</button>
                                    </a>
                                </td>
                        </tr>
                        @php
                                $i++;
                            @endphp
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
@endsection

{{-- pour eviter les confusions avec les id au niveau des tables --}}
@section('js')

<script>
    $(document).ready(function() {
        $('#datatable1').DataTable();
        $('#datatable2').DataTable();
        $('#datatable3').DataTable();
        $('#datatable4').DataTable();
    });
</script>
<script>
    $(document).on('click', '#btn_ajout_paiement', function(){

    var ID = $(this).attr('data-id');
    var montant = $(this).attr('data-montant')


    $('#add_id').val(ID);
    $('#add_montant').val(montant);


$('#ModalAjoutPaiement').modal('show');
});

</script>


@endsection
