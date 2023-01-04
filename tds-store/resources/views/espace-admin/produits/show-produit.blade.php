@extends('layouts.master-dashboard')

@section('update-produit')
@include('layouts.partials-dashboard.entête-page', [
'infos1' => 'Produit #' . $produit->id,
'infos2' => 'Produits',
'infos3' => 'Détails produit',
])
<br>

<div class="row">
    <div class="col-md-12">
        <div>
            <a href="{{ route('root_espace_admin_modifie_vue', $produit->id) }}">
                <button data-toggle="tooltip" title="Edit produit" class="btn btn-primary"><i class="fa fa-edit"></i> Editer</button>
            </a>

            <button id="btn_edit_image_produit" data-id="{{ $produit->id }}" data-toggle="tooltip" title="Edit image produit" class="btn btn-secondary"><i class="fa fa-image"></i> Upload</button>

            <a href="{{ route('root_espace_admin_show_images', $produit->id) }}">
                <button data-toggle="tooltip" title="Galerie images" id="btn_add_image"  class="btn"  style="background-color:#ffc107; border: #ffc107; color: white;"><i class="fa fa-imdb"></i> Galerie</button>
            </a>

            <button data-toggle="tooltip" title="Ajouter stock" id="btn_add_stock" class="btn" data-id={{ $produit->id}} style="background-color: #007bff; border: #007bff; color: white;"><i class="fa fa-plus"></i> Ajout stock</button>

            <button data-toggle="tooltip" title="Supprimer produit" id="btn_delete_produit" data-id="{{ $produit->id }}" class="btn" style="{{ couleur_background_2() }}; {{ couleur_blanche() }}"><i class="fa fa-trash" aria-hidden="true"></i> Supprimer</button>

            <button data-toggle="tooltip" title="Retirer fiche technique" id="btn_delete_fiche_technique" data-id="{{ $produit->id }}" class="btn" style="{{ couleur_background_2() }}; {{ couleur_blanche() }}"><i class="fa fa-trash" aria-hidden="true"></i> Retirer</button>

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
                {{-- <figure class="figure"> --}}
                    <img src="{{ path_image($produit->image_id) ? asset(path_image_produit() . path_image($produit->image_id)->filename) : ''}}" class="figure-img img-fluid rounded" alt="" height="50" width="60">
                {{-- </figure> --}}
                </td>
            </tr>
            @if($produit->file_id != null)
            <tr >
                <td>Fiche Technique</td>
                <td>
                    <iframe src="{{ path_image($produit->file_id) ? asset(path_fiche_technique() . path_image($produit->file_id)->filename) : ''}}" style="" height="1000px" width="100%"></iframe>
                </td>
            </tr>
            @endif
        </table>
        </div>
    </div>
</div>

@include('espace-admin.produits._modal')

@include('layouts.modal', ["route" => route('root_espace_admin_produit_delete', 0), 'nom'=>'cet produit'])


{{-- modal fiche technique --}}
<div class="modal fade" id="DeleteFicheTechnique" aria-labelledby="DeleteFicheTechnique" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Suppression </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('root_espace_admin_produit_fiche_technique_delete', 0) }}"  method="POST">
                @csrf
                @method('delete')
                <div class="modal-body">
                    <input  class="form-control"  type="hidden" id="fiche_id" placeholder="" name="id" >
                    <h5 class="text-center">Etes-vous sûr de vouloir retirer cette fiche ?</h5>
                </div>
                <div class="modal-footer" style="display:block;">
                    <button type="reset" class="btn btn-secondary" data-dismiss="modal">Non</button>
                    <button type="submit" class="btn btn-danger float-right">Oui, retirer</button>
                </div>
            </form>
       </div>
    </div>
</div>

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

    $(document).on('click', '#btn_delete_fiche_technique', function(){
        var id = $(this).attr('data-id');

        $('#fiche_id').val(id);

        $('#DeleteFicheTechnique').modal('show');
    });

</script>
@endsection

