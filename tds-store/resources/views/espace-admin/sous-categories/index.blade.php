@extends('layouts.master-dashboard')

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
                <h4 class="mt-3 header-title text-white d-inline-block " style="font-size: 24px;">Toutes les categories</h4>
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
                        @foreach ($sous_categories as $sous_categorie)
                        <tr>
                            <td>{{ $sous_categorie->id }}</td>
                            <td>{{ $sous_categorie->nom }}</td>
                            <td>{{ $sous_categorie->categorie->nom}}</td>
                            <td>
                                <a href="{{ route('root_espace_admin_details_sous_categorie', $sous_categorie->id) }}">
                                    <button data-toggle="tooltip" title="Voir" id="btn_edit_sous_categorie" class="btn" style="background-color: #007bff; border: #007bff; color: white;"><i class="fa fa-eye"></i></button>
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

<div class="modal fade" id="ModalModifieSousCategorie" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="ModalModifieSousCategorie" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Modifier une sous-catégorie</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('root_espace_admin_edit_sous_categorie')}}"  method="POST">
                @csrf
                <div class="modal-body" style="background-color: #f0f0f0;">
                    <div class="">
                        <input id="edit_id" class="form-control {{ $errors->has('id') ? 'is-invalid' : '' }}" style="height: 50px;" type="hidden" placeholder="" name="id" >
                        <div class="form-group">

                            <input class="form-control {{ $errors->has('nom') ? 'is-invalid' : '' }}" style="height: 50px;" type="text" placeholder="entrez la sous-catégorie" name="nom" id="edit_nom">
                            {!! $errors->first('nom', '<p class="text-danger">:message</p>') !!}
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="button" type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn" style="{{ couleur_background_1() }}; {{ couleur_blanche() }}">Modifier</button>

                </div>
            </form>
       </div>
    </div>
</div>

<div class="modal fade" id="ModalAjoutSousCategorie" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="ModalAjoutSousCategorie" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Ajouter une nouvelle catégorie</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('root_espace_admin_create_sous_categorie')}}"  method="POST">
                @csrf
                <div class="modal-body" style="background-color: #f0f0f0;">
                    <div class="form-group">
                        <label for="">Nom</label>
                        <input class="form-control {{ $errors->has('nom') ? 'is-invalid' : '' }}" style="height: 50px;" type="text" placeholder="Entrez la sous-catégorie" name="nom">
                        {!! $errors->first('nom', '<p class="text-danger">:message</p>') !!}
                    </div>
                    <div class=" form-group">
                        <label for="">Catégorie</label>
                        <select class="custom-select {{ $errors->has('categorie') ? 'is-invalid' : '' }}" style="height: 50px;" name="categorie" >
                            <option value="">Choisir une catégorie</option>
                            @foreach ($categories as $categorie)
                            <option value="{{ $categorie->id }}">{{ $categorie->nom }}</option>
                            @endforeach
                        </select>
                        {!! $errors->first('categorie', '<p class="text-danger">:message</p>') !!}
                    </div>

                </div>
                <div class="modal-footer">
                    <button id="button" type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn" style="{{ couleur_background_1() }}; {{ couleur_blanche() }}">Ajouter</button>

                </div>
            </form>
       </div>
    </div>
</div>

@include('layouts.modal', ["route" => route('root_espace_admin_delete_sous_categorie', 0), 'nom'=>'cette sous-catégorie'])


@endsection
@section('js')
<script>
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
