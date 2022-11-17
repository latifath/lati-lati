@extends('layouts.master-dashboard')

@section('head')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.2.0/dist/select2-bootstrap-5-theme.min.css" />
@endsection

@section('sous-categorie')

    @include('layouts.partials-dashboard.entête-page', [
        'infos1' => 'Sous-catégories',
        'infos2' => 'Sous-catégories',
        'infos3' => 'Toutes les Sous-catégories',
    ])
    <br>
    <div class="row">
        <div class="col-md-12 col-12">
            <div class="card m-b-30">
            <div class="card-header bg-success">
                    <h4 class="mt-3 header-title text-white d-inline-block " style="font-size: 24px;">Toutes les sous categories</h4>
                    <button id="btn_ajout_sous_categorie" class="float-right btn d-inline-block text-white border" style="font-size: 24px; {{ couleur_background_1() }}">Ajouter une sous-catégorie</button>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; {{ couleur_principal() }}">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nom</th>
                            <th>Catégorie</th>
                            <th style="width: 15%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($sous_categories as $key => $sous_categorie)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $sous_categorie->nom }}</td>
                                <td>{{ $sous_categorie->categorie->nom}}</td>
                                <td>
                                    <a href="{{ route('root_espace_admin_details_sous_categorie', $sous_categorie->id) }}">
                                        <button data-toggle="tooltip" title="Voir" class="btn" style="background-color: #007bff; border: #007bff; color: white;"><i class="fa fa-eye"></i></button>
                                    </a>
                                    <button data-toggle="tooltip" title="Editer" id="btn_edit_sous_categorie" data-id="{{ $sous_categorie->id }}" data-nom="{{ $sous_categorie->nom }}" class="btn btn-primary"><i class="fa fa-edit"></i></button>
                                    <button  data-toggle="tooltip" title="Supprimer" id="btn_delete_sous_categorie" data-id="{{ $sous_categorie->id }}" class="btn" style="{{ couleur_background_2() }}; {{ couleur_blanche() }}"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                </td>
                            @endforeach
                            </tr>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('espace-admin.sous-categories._form');

    @include('layouts.modal', ["route" => route('root_espace_admin_delete_sous_categorie', 0), 'nom'=>'cette sous-catégorie'])


@endsection
@section('js')

<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>

<script>
    $( 'select' ).select2( {
        theme: "bootstrap-5",
        width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
        placeholder: $( this ).data( 'placeholder' ),
    } );

    $(document).on('click', '#btn_edit_sous_categorie', function(){
        var ID = $(this).attr('data-id');
        var nom = $(this).attr('data-nom');

        $('#edit_id').val(ID);
        $('#edit_nom').val(nom);

        $('#ModalModifieSousCategorie').modal('show');
    });

    $(document).on('click', '#btn_ajout_sous_categorie', function(){

    $('#ModalAjoutSousCategorie').modal('show');
    });

    $(document).on('click', '#btn_delete_sous_categorie', function(){
        var ID = $(this).attr('data-id');

        $('#item_id').val(ID);

        $('#DeleteModalCenter').modal('show');
    });

</script>
@endsection
