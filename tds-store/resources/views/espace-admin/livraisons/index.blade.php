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
                            <th>Adresse <br> Livraison</th>
                            <th>Téléphone</th>
                            <th>Montant <br> Expédition</th>
                            <th>Numéro de <br>commande</th>
                            <th style="width: 10%;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($livraisons_incomplète as $livraison_incomplète)
                        <tr>
                            <td>{{ $livraison_incomplète->commande->adresse_livraison->rue }} {{ $livraison_incomplète->commande->adresse_livraison->ville }}</td>
                            <td>{{ $livraison_incomplète->commande->adresse_livraison->telephone }}</td>
                            <td>{{ number_format($livraison_incomplète->montant, '0', '.', '')}} F CFA</td>
                            <td>{{ $livraison_incomplète->commande->id }}</td>
                            <td>
                                {{-- <a href="{{ route('root_espace_admin_modification_statut_livraison', $livraison_incomplète->id) }}">
                                    <button data-toggle="tooltip" title="Livrer" class="btn text-white" style="background-color: #28a745;"><i class="fa fa-check"></i></i></button>
                                </a> --}}
                                <button data-toggle="tooltip" title="Ajouter" id="btn_edit_frais_exp" data-id="{{ $livraison_incomplète->id }}" data-montant="{{ $livraison_incomplète->montant }}" class="btn btn-primary"><i class="fa fa-plus"></i></i></button>

                                <button data-toggle="tooltip" title="Supprimer" id="btn_delete_livraison" data-id="{{ $livraison_incomplète->id }}" class="btn bg-danger text-white"><i class="fa fa-trash"></i></i></button>
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
                <h4 class="mt-0 header-title text-white" style="font-size: 24px; text-align: center;">Livraisons</h4>
            </div>

            <div class="card-body">
                <table id="datatable1" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; {{ couleur_principal() }}">
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
                        @foreach ($livraisons as $livraison)
                        <tr>
                            <td>{{ $livraison->commande->adresse_livraison->rue }} {{ $livraison->commande->adresse_livraison->ville }}</td>
                            <td>{{ $livraison->commande->adresse_livraison->telephone }}</td>
                            <td>{{ number_format($livraison->montant, '0', '.', '')}} F CFA</td>
                            <td>{{ $livraison->commande->id }}</td>
                            <td>
                                {{-- <a href="{{ route('root_espace_admin_modification_statut_livraison', $livraison->id) }}"> --}}
                                    <button id="btn_confirm_livraison" data-id="{{ $livraison->id }}" data-toggle="tooltip" title="Valider" class="btn text-white" style="background-color: #28a745;"><i class="fa fa-check"></i></i></button>
                                {{-- </a> --}}
                                <button data-toggle="tooltip" title="Supprimer" id="btn_delete_livraison" data-id="{{ $livraison->id }}" class="btn bg-danger text-white"><i class="fa fa-trash"></i></i></button>
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
                        @foreach ($livraisons_valide as $livraison_valide)
                        <tr>
                            <td>{{ $livraison_valide->commande->adresse_livraison->rue }} {{ $livraison_valide->commande->adresse_livraison->ville }}</td>
                            <td>{{ $livraison_valide->commande->adresse_livraison->telephone }}</td>
                            <td>{{ number_format($livraison_valide->montant, '0', '.', '')}} F CFA</td>
                            <td>{{ $livraison_valide->commande->id }}</td>
                            <td>
                                <button data-toggle="tooltip" title="Supprimer" id="btn_delete_livraison" data-id="{{ $livraison_valide->id }}" class="btn bg-danger text-white"><i class="fa fa-trash"></i></i></button>
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

</script>
@endsection
