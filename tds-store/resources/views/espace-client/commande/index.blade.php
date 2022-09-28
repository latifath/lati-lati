@extends('layouts.master-dashboard')
@section('contenu-commande')

@include('layouts.partials-dashboard.entête-page', [
    'infos1' => 'Commandes',
    'infos2' => 'Commandes',
    'infos3' => 'Toutes les commandes',
])
<br>
    <div class="row">
        <div class="col-12">
            <div class="card m-b-30">
                <div class="card-header bg-success">
                    <h4 class="mt-0 header-title text-white" style="font-size: 24px; text-align: center;">Commande terminée</h4>
                </div>

                <div class="card-body">
                    <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; {{ couleur_principal() }}">
                        <thead>
                        <tr>
                            <th>N°</th>
                            <th>Date</th>
                            <th>Montant</th>
                            <th>Type de paiement</th>
                            <th style="width: 10%">Action</th>
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
        </div> <!-- end col -->
    </div> <!-- end row -->

    <div class="row">
        <div class="col-12">
            <div class="card m-b-30">
                <div class="card-header bg-success">
                    <h4 class="mt-0 header-title text-white" style="font-size: 24px; text-align: center;"> Commande en cours</h4>
                </div>

                <div class="card-body">
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
        </div> <!-- end col -->
    </div> <!-- end row -->


    {{-- tableau commande annuler  --}}
    <div class="row">
        <div class="col-12">
            <div class="card m-b-30">
                <div class="card-header bg-success">
                    <h4 class="mt-0 header-title text-white" style="font-size: 24px; text-align: center;">Commande annulée</h4>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                    <table id="datatable2" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; {{ couleur_principal() }}">
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
                                <td>{{ number_format (montant_ttc(montant_apres_reduction_sans_session(total_commande($item->id), $item->promotion), $item->adresse_livraison_id), 0, '.', ' ') }} F CFA</td>
                                {{-- <td>{{ number_format(account_commande($item->id)->montant, 0, '.', ' ' )}} F CFA</td> --}}
                                {{-- <td>{{ account_commande($item->id)->type_paiement}}</td> --}}
                                <td></td>

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
        </div> <!-- end col -->
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card m-b-30">
                <div class="card-header bg-success">
                    <h4 class="mt-0 header-title text-white" style="font-size: 24px; text-align: center;">Commande non payée</h4>
                </div>

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
                            @foreach($list_commandes_non_payee  as $item)

                            <tr>
                                <td>{{ $i}}</td>
                                <td>{{ $item->created_at}}</td>
                                <td>{{ number_format(montant_ttc(montant_apres_reduction_sans_session(total_commande($item->id), $item->promotion), $item->adresse_livraison_id),  0, '.', ' ' ) }} F CFA</td>
                                <td>Néant</td>
                                <td>
                                    <a href="{{ route('root_espace_client_commande_show', $item->id) }}">
                                        <button class="btn" style="background-color: #007bff; border: #007bff; color: white;" ><i class="fa fa-eye" aria-hidden="true"></i> Voir</button>
                                    </a>

                                    {{-- <button id="btn_ajout_paiement" data-id="{{ $item->id }}" data-montant="{{montant_ttc(montant_apres_reduction_sans_session(total_commande($item->id), $item->promotion), $item->adresse_livraison_id) }}" class="btn" style="background-color:#ffc107; border: #ffc107; color: white;"><i class="fa fa-money"></i> Payer</button> --}}

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
        </div> <!-- end col -->
    </div> <!-- end row -->

    <div class="row">
        <div class="col-12">
            <div class="card m-b-30">
                <div class="card-header bg-success">
                    <h4 class="mt-0 header-title text-white" style="font-size: 24px; text-align: center;">Commande en attente de paiement</h4>
                </div>

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
        </div> <!-- end col -->
    </div> <!-- end row -->
    @include('espace-client.commande._modal');
@endsection

{{-- pour eviter les confusion avec les id au niveau des tables --}}
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
