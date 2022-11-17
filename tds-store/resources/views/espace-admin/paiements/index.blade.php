@extends('layouts.master-dashboard')
@section('paiement')

@include('layouts.partials-dashboard.entête-page', [
'infos1' => 'Paiements',
'infos2' => 'Paiements',
'infos3' => 'Tous les paiements',
])
<br>

<div class="row">
    <div class="col-md-12 col-12">
        <div class="card m-b-30">
            <div class="card-header bg-success">
                <h4 class="mt-0 header-title text-white" style="font-size: 24px; text-align: center;">Paiements</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; {{ couleur_principal() }}">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Date</th>
                                <th>Reference</th>
                                <th>Type de paiement</th>
                                <th>Montant</th>
                                <th>Commande N°</th>
                                <th style="width: 15%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($paiements as $key => $paiement)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $paiement->created_at }}</td>
                                    <td>{{ $paiement->reference }}</td>
                                    <td>{{ $paiement->type_paiement }}</td>
                                    <td>{{ number_format($paiement->montant, '0', '.', ' ')}} F CFA</td>
                                    <td>{{ $paiement->commande_id }}</td>
                                    <td>
                                        <button data-toggle="tooltip" title="Voir" id="btn_details_commande" class="btn" style="background-color: #007bff; border: #007bff; color: white;" data-id="{{ commande($paiement->commande_id)->id}}" data-date="{{ commande($paiement->commande_id)->created_at}}" data-statut="{{ commande($paiement->commande_id)->status }}"><i class="fa fa-eye" aria-hidden="true"></i></button>
                                        <button data-toggle="tooltip" title="Editer" id="btn_edit_paiement" data-id="{{ $paiement->id }}" data-montant="{{ $paiement->montant }}" data-date="{{ $paiement->created_at }}" class="btn btn-primary"><i class="fa fa-edit"></i></button>
                                        <button data-toggle="tooltip" title="Supprimer" id="btn_delete_paiement" data-id="{{ $paiement->id }}" class="btn" style="{{ couleur_background_2() }}; {{ couleur_blanche() }}"><i class="fa fa-trash" aria-hidden="true"></i></button>

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

@include('espace-admin.paiements._modal')

@include('layouts.modal', ["route" => route('root_espace_admin_delete_paiement', 0), 'nom'=>'cet paiement'])

@endsection

@section('js')
<script>
    $(document).on('click', '#btn_details_commande', function() {

        var ID = $(this).attr('data-id');
        var date = $(this).attr('data-date');
        var statut = $(this).attr('data-statut');

        $('#id_com').html(ID);
        $('#date_com').html(date);
        $('#statut').html(statut);

        $('#DetailsModalCommande').modal('show');
    });

    $(document).on('click', '#btn_edit_paiement', function() {
        var ID = $(this).attr('data-id');
        var montant = $(this).attr('data-montant');
        var date = $(this).attr('data-date');
        var type_paiement = $(this).attr('data-type_paiement');
        var commande_id = $(this).attr('data-commande_id')

        $('#edit_id').val(ID);
        $('#edit_montant').val(montant);
        $('#edit_date').val(date);
        $('#edit_type').val(type_paiement);
        $('#edit_commande_id').val(commande_id);



        $('#ModalModifiePaiement').modal('show');
    });

    $(document).on('click', '#btn_delete_paiement', function() {
        var ID = $(this).attr('data-id');

        $('#item_id').val(ID);

        $('#DeleteModalCenter').modal('show');
    });

</script>
@endsection
