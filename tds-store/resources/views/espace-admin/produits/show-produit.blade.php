@extends('layouts.master-dashboard')

@section('update-produit')
@include('layouts.partials-dashboard.entête-page', [
'infos1' => 'Produits',
'infos2' => 'Produits',
'infos3' => 'Détails produit',
])
<br>

<div class="row">
    <div class="col-md-12">
        <div>
            <a href="{{ route('root_espace_admin_modifie_vue', $produit->id) }}">
                <button data-toggle="tooltip" title="Edit produit" class="btn btn-primary"><i class="fa fa-edit"></i>Editer</button>
            </a>

            <button id="btn_edit_image_produit" data-id="{{ $produit->id }}" data-toggle="tooltip" title="Edit image produit" class="btn btn-info"><i class="fa fa-image"></i>Upload</button>

            <button data-toggle="tooltip" title="Supprimer produit" id="btn_delete_produit" data-id="{{ $produit->id }}" class="btn" style="{{ couleur_background_2() }}; {{ couleur_blanche() }}"><i class="fa fa-trash" aria-hidden="true"></i>Supprimer</button>

            <a href="{{ route('root_espace_admin_show_images', $produit->id) }}">
                <button data-toggle="tooltip" title="Galerie images" id="btn_add_image"  class="btn"  style="background-color:#ffc107; border: #ffc107; color: white;"><i class="fa fa-imdb"></i> Galerie</button>
            </a>

            <button data-toggle="tooltip" title="Ajouter stock" id="btn_add_stock" class="btn" data-id={{ $produit->id}} style="background-color: #007bff; border: #007bff; color: white;"><i class="fa fa-plus"></i> Ajout stock</button>

        </div>
        <div class="table-responsive">
        <table class="table table-striped table-bordered dt-responsive nowrap mt-4">
            <tr>
                <td>Nom</td>
                <td>{{ $produit->nom }}</td>
            </tr>
            <tr>
                <td>Prix</td>
                <td>{{ $produit->prix }}</td>
            </tr>
            <tr>
                <td>Quantite</td>
                <td>{{ $produit->quantite }}</td>
            </tr>
            <tr>
                <td>Sous_categorie</td>
                <td>{{ $produit->sous_categorie->nom }}</td>
            </tr>
            <tr>
                <td>Categorie</td>
                <td>{{ $produit->sous_categorie->categorie->nom }}</td>
            </tr>
            <tr>
                <td>Description</td>
                <td>{!! $produit->description !!}</td>
            </tr>
            <tr >
                <td>Produit</td>
                <td>
                <figure class="figure">
                    <img src="{{ path_image($produit->image) ? asset(path_image_produit() . path_image($produit->image)->filename) : ''}}" class="figure-img img-fluid rounded" alt="" height="50" width="60">
                </figure></td>
            </tr>
        </table>
        </div>
    </div>
</div>

<div class="modal fade" id="ModalAjoutStock" data-backdrop="static" data-keyboasrd="false" tabindex="-1" aria-labelledby="ModalAjoutStock" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Ajouter un nouveau stock</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <br>
            <form action="{{ route('root_espace_admin_stock_create') }}"  method="POST">
                @csrf
                <div class="modal-body" style="background-color: #f0f0f0;">

                <input class="form-control {{ $errors->has('produit') ? 'is-invalid' : '' }}" style="height: 50px;" type="hidden" placeholder="" name="produit" id="add_stock_id">

                <div class="form-group">
                    <label for="">Prix Unitaire</label>
                    <input class="form-control {{ $errors->has('prix_unitaire') ? 'is-invalid' : '' }}" style="height: 50px;" type="text" placeholder="" name="prix_unitaire">
                    {!! $errors->first('prix_unitaire', '<p class="text-danger">:message</p>') !!}
                </div>

                <div class="form-group">
                    <label for="">Quantité</label>
                    <input class="form-control {{ $errors->has('quantite') ? 'is-invalid' : '' }}" style="height: 50px;" type="text" placeholder="" name="quantite">
                    {!! $errors->first('quantite', '<p class="text-danger">:message</p>') !!}
                </div>

                <div class="modal-footer float-right">
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </div>
                </div>
            </form>
       </div>
    </div>
</div>

<div class="modal fade" id="ModalModifieImageProduit" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="ModalModifieImageProduit" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Upload Image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('root_espace_admin_modifie_image_produit') }}"  method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="modal-body" style="background-color: #f0f0f0;">
                <input class="form-control {{ $errors->has('id') ? 'is-invalid' : '' }}" style="height: 50px;" type="hidden" placeholder="" name="id" id="edit_image_id">

                <div class="form-group">
                    <label for="">Image</label>
                    <input class="form-control {{ $errors->has('image') ? 'is-invalid' : '' }}" style="height: 50px;" type="file" placeholder="" name="image">
                    {!! $errors->first('image', '<p class="text-danger">:message</p>') !!}
                </div>
                <div class="modal-footer float-right">
                    <button type="submit" class="btn btn-primary">Modifier</button>
                </div>
                </div>
            </form>
       </div>
    </div>
</div>


@include('layouts.modal', ["route" => route('root_espace_admin_produit_delete', 0), 'nom'=>'cet produit'])

@endsection

@section('js')
<script>
    $(document).on('click', '#btn_delete_produit', function() {
        var ID = $(this).attr('data-id');

        $('#item_id').val(ID);

        $('#DeleteModalCenter').modal('show');
    });

    $(document).on('click', '#btn_add_stock', function(){

    var ID = $(this).attr('data-id');

    $('#add_stock_id').val(ID);

    $('#ModalAjoutStock').modal('show');
    });

    $(document).on('click', '#btn_edit_image_produit', function(){
        var id = $(this).attr('data-id');

        $('#edit_image_id').val(id);

        $('#ModalModifieImageProduit').modal('show');
    });


</script>
@endsection

