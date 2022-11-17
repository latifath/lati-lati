@extends('layouts.master-dashboard')
@section('expedition')
@include('layouts.partials-dashboard.entête-page', [
    'infos1' => 'Livraisons',
    'infos2' => 'Livraisons',
    'infos3' => 'Expédition',
])
<br>

<div class="row">
    <div class="col-md-12 col-12">
        <div class="card m-b-30">
           <div class="card-header bg-success">
                <h4 class="mt-3 header-title text-white d-inline-block " style="font-size: 24px;">Expéditions</h4>
                <button id="btn_ajout_expédition" class="float-right btn d-inline-block text-white border" style="font-size: 24px; {{ couleur_background_1() }}"> <i class="fa fa-plus" aria-hidden="true"> Ajouter une expédition</i></button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; {{ couleur_principal() }}">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Ville</th>
                        <th>Montant</th>
                        <th style="width: 10%">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($expeditions as $expedition)
                        <tr>
                            <td>{{ $expedition->id }}</td>
                            <td>{{ $expedition->ville }}</td>
                            <td>{{ $expedition->montant }}</td>
                            <td>
                                <button  data-toggle="tooltip" title="Editer" id="btn_edit_expedition"  data-id="{{ $expedition->id }}" data-ville="{{ $expedition->ville }}" data-montant="{{ $expedition->montant }}" class="btn btn-primary"><i class="fa fa-edit"></i></button>
                                <button  data-toggle="tooltip" title="Supprimer" id="btn_delete_expedition"  data-id="{{ $expedition->id }}" class="btn" style="{{ couleur_background_2() }}; {{ couleur_blanche() }}"><i class="fa fa-trash" aria-hidden="true"></i></button>
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

@include('espace-admin.livraisons._modal');


@include('layouts.modal', ["route" => route('root_espace_admin_delete_expedition', 0), 'nom'=>'cette expédition'])

@endsection

@section('js')

<script>
    $(document).on('click', '#btn_ajout_expédition', function(){

       $('#ModalAjoutExpédition').modal('show');
   });

   $(document).on('click', '#btn_edit_expedition', function(){
        var ID = $(this).attr('data-id');
        var ville = $(this).attr('data-ville');
        var montant = $(this).attr('data-montant');

        $('#edit_id').val(ID);
        $('#edit_ville').val(ville);
        $('#edit_montant').val(montant);

        $('#ModalModifieExpedition').modal('show');
    });

    $(document).on('click', '#btn_delete_expedition', function(){
        var ID = $(this).attr('data-id');

        $('#item_id').val(ID);

        $('#DeleteModalCenter').modal('show');
    });

</script>
@endsection
