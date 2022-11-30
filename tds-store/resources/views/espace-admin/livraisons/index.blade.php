@extends('layouts.master-dashboard')
@section('livraison')
@include('layouts.partials-dashboard.entête-page', [
    'infos1' => 'Livraisons',
    'infos2' => 'Livraisons',
    'infos3' => 'Info livraisons',
])
<br>
<div class="row">
    <div class="col-md-12 col-12">
        <div class="card m-b-30">
            <div class="card-header bg-success">
                <h4 class="mt-0 header-title text-white" style="font-size: 24px; text-align: center;">Livraisons Incomplètes</h4>
            </div>
            <div class="card-body">
                <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; {{ couleur_principal() }}">
                    <thead>
                        <tr>
                            <th>Adresse  Livraison</th>
                            <th>Téléphone</th>
                            <th>Montant Expédition</th>
                            <th>Numéro de commande</th>
                            <th style="width: 10%;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dispatch_incomplete as $item)
                            <tr>
                                <td>{{ $item->commande->adresse_livraison->rue }} {{ $item->commande->adresse_livraison->ville }}</td>
                                <td>{{ $item->commande->adresse_livraison->telephone }}</td>
                                <td>{{ number_format($item->montant, '0', '.', '')}} F CFA</td>
                                <td>{{ $item->commande->id }}</td>
                                <td>
                                    {{-- <button data-toggle="tooltip" title="Ajouter" id="btn_edit_frais_exp" data-id="{{ $item->id }}" data-montant="{{ $item->montant }}" class="btn btn-primary"><i class="fa fa-plus"></i></i></button> --}}
                                    <button data-toggle="tooltip" title="Génération facture" id="btn_generate_facture" class="btn btn-primary" data-user="{{ $item->commande->user_id }}" data-livraison="{{ $item->id }}"><i class="fa fa-refresh"></i></i></button>
                                    <button data-toggle="tooltip" title="Supprimer" id="btn_delete_livraison" data-id="{{ $item->id }}" class="btn bg-danger text-white"><i class="fa fa-trash"></i></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-12">
        <div class="card m-b-30">
            <div class="card-header bg-success">
                <h4 class="mt-0 header-title text-white" style="font-size: 24px; text-align: center;">Livraisons Facture Incomplètes</h4>
            </div>
            <div class="card-body">
                <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; {{ couleur_principal() }}">
                    <thead>
                        <tr>
                            <th>Adresse  Livraison</th>
                            <th>Téléphone</th>
                            <th>Montant Expédition</th>
                            <th>Numéro de commande</th>
                            <th style="width: 10%;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dispatch_invoice_incomplete as $item)
                            @if (!invoice_terminate($item->invoice_id)->status)
                                <tr>
                                    <td>{{ $item->commande->adresse_livraison->rue }} {{ $item->commande->adresse_livraison->ville }}</td>
                                    <td>{{ $item->commande->adresse_livraison->telephone }}</td>
                                    <td>{{ number_format($item->montant, '0', '.', '')}} F CFA</td>
                                    <td>{{ $item->commande->id }}</td>
                                    <td>
                                        {{-- <button data-toggle="tooltip" title="Ajouter" id="btn_edit_frais_exp" data-id="{{ $item->id }}" data-montant="{{ $item->montant }}" class="btn btn-primary"><i class="fa fa-plus"></i></i></button> --}}
                                        @if ($item->invoice_id)
                                            <a href="{{ route('root_espace_admin_index_facture', $item->invoice_id) }}">
                                                <button data-toggle="tooltip" title="Génération facture" id="" class="btn btn-primary" ><i class="fa fa-refresh"></i></i></button>
                                            </a>
                                        @else
                                            <button data-toggle="tooltip" title="Génération facture" id="btn_generate_facture" class="btn btn-primary" data-user="{{ $item->commande->user_id }}" data-livraison="{{ $item->id }}"><i class="fa fa-refresh"></i></i></button>
                                        @endif
                                        <button data-toggle="tooltip" title="Supprimer" id="btn_delete_livraison" data-id="{{ $item->id }}" class="btn bg-danger text-white"><i class="fa fa-trash"></i></i></button>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 col-12">
        <div class="card m-b-30">
            <div class="card-header bg-success">
                <h4 class="mt-0 header-title text-white" style="font-size: 24px; text-align: center;">Livraisons</h4>
            </div>

            <div class="card-body">
                <table id="datatable1" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; {{ couleur_principal() }}">
                    <thead>
                    <tr>
                        <th>Adresse Livraison</th>
                        <th>Téléphone</th>
                        <th>Montant Expédition</th>
                        <th>Numéro de commande</th>
                        <th style="width: 10%;">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($dispatch as $item)
                            @if (!$item->invoice_id)
                                <tr>
                                    <td>{{ $item->commande->adresse_livraison->rue }} {{ $item->commande->adresse_livraison->ville }}</td>
                                    <td>{{ $item->commande->adresse_livraison->telephone }}</td>
                                    <td>{{ number_format($item->montant, '0', '.', '')}} F CFA</td>
                                    <td>{{ $item->commande->id }}</td>
                                    <td>
                                        <button id="btn_confirm_livraison" data-id="{{ $item->id }}" data-toggle="tooltip" title="Valider" class="btn text-white" style="background-color: #28a745;"><i class="fa fa-check"></i></i></button>

                                        <button data-toggle="tooltip" title="Supprimer" id="btn_delete_livraison" data-id="{{ $item->id }}" class="btn bg-danger text-white"><i class="fa fa-trash"></i></i></button>
                                    </td>
                                </tr>
                            @elseif(invoice_terminate($item->invoice_id)->status)
                                <tr>
                                    <td>{{ $item->commande->adresse_livraison->rue }} {{ $item->commande->adresse_livraison->ville }}</td>
                                    <td>{{ $item->commande->adresse_livraison->telephone }}</td>
                                    <td>{{ number_format($item->montant, '0', '.', '')}} F CFA</td>
                                    <td>{{ $item->commande->id }}</td>
                                    <td>
                                        <button id="btn_confirm_livraison" data-id="{{ $item->id }}" data-toggle="tooltip" title="Valider" class="btn text-white" style="background-color: #28a745;"><i class="fa fa-check"></i></i></button>

                                        <button data-toggle="tooltip" title="Supprimer" id="btn_delete_livraison" data-id="{{ $item->id }}" class="btn bg-danger text-white"><i class="fa fa-trash"></i></i></button>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 col-12">
        <div class="card m-b-30">
            <div class="card-header bg-success">
                <h4 class="mt-0 header-title text-white" style="font-size: 24px; text-align: center;">Livraisons Validées</h4>
            </div>
            <div class="card-body">
                <table id="datatable2" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; {{ couleur_principal() }}">
                    <thead>
                        <tr>
                            <th>Adresse <br> Livraison</th>
                            <th>Téléphone</th>
                            <th>Montant <br> Expédition</th>
                            <th>Numéro de <br>commande</th>
                            <th style="width: 10%;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dispatch_validate as $dispatch)
                        <tr>
                            <td>{{ $dispatch->commande->adresse_livraison->rue }} {{ $dispatch->commande->adresse_livraison->ville }}</td>
                            <td>{{ $dispatch->commande->adresse_livraison->telephone }}</td>
                            <td>{{ number_format($dispatch->montant, '0', '.', '')}} F CFA</td>
                            <td>{{ $dispatch->commande->id }}</td>
                            <td>
                                <button data-toggle="tooltip" title="Supprimer" id="btn_delete_livraison" data-id="{{ $dispatch->id }}" class="btn bg-danger text-white"><i class="fa fa-trash"></i></i></button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@include('espace-admin.livraisons._modal_frais_exp')

@include('layouts.modal', ["route" => route('root_espace_admin_delete_livraisons', 0), 'nom'=>'cette livraison'])

@endsection

@section('js')
<script>
    $(document).ready(function() {
        $('#datatable1').DataTable();
    });
    $(document).ready(function() {
        $('#datatable2').DataTable();
    });
</script>
<script>
    //  $(document).on('click', '#btn_delete_livraison', function() {
    //     var ID = $(this).attr('data-id');

    //     $('#item_id').val(ID);

    //     $('#DeleteModalCenter').modal('show');
    // });

    $(document).on('click', '#btn_edit_frais_exp', function(){
        var ID = $(this).attr('data-id');
        var montant = $(this).attr('data-montant');

        $('#edit_id').val(ID);
        $('#edit_montant').val(montant);


        $('#ModalEditFraisExpédition').modal('show');
    });

    $(document).on('click', '#btn_confirm_livraison', function(){
       var id = $(this).attr('data-id');

       $('#item_id').val(id);

       $('#ModalConfirmationLivraison').modal('show');
   });

   $(document).on('click', '#btn_generate_facture', function(){
        var user = $(this).attr('data-user');
        var livraison = $(this).attr('data-livraison');

        $('#user_id').val(user);
        $('#livraison_id').val(livraison);

       $('#ModalGenerateFacture').modal('show');
   });
</script>
@endsection
