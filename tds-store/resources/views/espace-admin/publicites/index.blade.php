@extends('layouts.master-dashboard')


@section('publicites')

@include('layouts.partials-dashboard.entête-page', [
    'infos1' => 'Publicités',
    'infos2' => 'Publicités',
    'infos3' => 'Publicités',
])
<br>

<div class="row">
    <div class="col-md-12 col-12">
        <div class="card m-b-30">
           <div class="card-header bg-success">
                <h4 class="mt-3 header-title text-white text-center  d-inline-block" style="font-size: 24px;">Publicités</h4>
                <button  id="btn_ajout_publicite" class="float-right btn d-inline-block text-white border"  {{ couleur_background_1() }}><i class="fa fa-plus" aria-hidden="true"> Ajouter une publicité</i></button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table  id="datatable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; {{ couleur_principal() }}">
                        <thead>
                        <tr>
                            <td>N°</td>
                            <th>Nom</th>
                            <th>Message</th>
                            <th>Numéro d'ordre</th>
                            <th>Path</th>
                            <th style="width: 20%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($publicites as $key => $publicite)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $publicite->nom }}</td>
                                    <td>{{ $publicite->message }}</td>
                                    <td>{{ $publicite->number_order }}</td>
                                    <td>
                                        <img src="{{ asset(path_image_publicite() . path_image($publicite->image_id)->filename) }}" class="figure-img img-fluid rounded" alt="" height="40" width="50">
                                    </td>
                                    <td>
                                        <button id="btn_edit_publicite" data-id="{{ $publicite->id }}" data-nom="{{ $publicite->nom }}" data-message="{{ $publicite->message }}" data-ordre="{{ $publicite->number_order }}" class="btn btn-primary"><i class="fa fa-edit"></i> Editer</button>
                                        <button id="btn_edit_image_publicite" data-id="{{ $publicite->id }}" class="btn btn-info"><i class="fa fa-image"></i> Upload</button>
                                        <button id="btn_delete_publicite" data-id="{{ $publicite->id }}" class="btn" style="{{ couleur_background_2() }}; {{ couleur_blanche() }}"><i class="fa fa-trash"></i> Supprimer</button>
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

@include('espace-admin.publicites._modal')


@include('layouts.modal', ["route" => route('root_espace_admin_supprimer_publicites', 0), 'nom'=>'cette publicitée'])

@endsection

@section('js')
<script>

$(document).on('click', '#btn_ajout_publicite', function(){

var ID = $(this).attr('data-id');


$('#add_id').val(ID);

$('#ModalAjoutPublicite').modal('show');
});

$(document).on('click', '#btn_edit_publicite', function(){

        var id = $(this).attr('data-id');
        var nom = $(this).attr('data-nom');
        var message = $(this).attr('data-message');
        var ordre = $(this).attr('data-ordre');

        $('#edit_id').val(id);
        $('#edit_nom').val(nom);
        $('#edit_message').val(message);
        $('#edit_ordre_de_numero').val(ordre);

        $('#ModalModifiepublicite').modal('show');
});

$(document).on('click', '#btn_edit_image_publicite', function(){

var id = $(this).attr('data-id');


$('#edit_image_id').val(id);

$('#ModalModifieImagepublicite').modal('show');
});


$(document).on('click', '#btn_delete_publicite', function(){

    var ID = $(this).attr('data-id');

    $('#item_id').val(ID);

    $('#DeleteModalCenter').modal('show');
});


</script>
@endsection
