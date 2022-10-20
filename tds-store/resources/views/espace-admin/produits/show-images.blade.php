@extends('layouts.master-dashboard')


@section('show-images')

@include('layouts.partials-dashboard.entête-page', [
    'infos1' => 'Produits',
    'infos2' => 'Tous le produits',
    'infos3' => 'Galerie images',
])
<br>
<div class="row">
    <button  id="btn_add_image" data-id={{ $produit->id}} class="btn d-inline-block text-white border" style="font-size: 24px; {{ couleur_background_1() }}">Ajouter une image au produit</button>
    <div class="col-md-12 col-12">
        @foreach ($produit->images as $img)
            <figure class="figure px-4 pt-5">
                <img src="{{ $img->filename ? asset(path_image_produit() . $img->filename) : '' }}" class="figure-img img-fluid rounded" alt="" height="300" width="300">
                <div class="row pt-3">
                    <button  id="btn_delete_image" data-id="{{ $img->id }}" data-toggle="tooltip"  title="Supprimer" id="btn_delete_image" class="btn mx-3" style="{{ couleur_background_2() }}; {{ couleur_blanche() }}"><i class="fa fa-trash" aria-hidden="true"></i></button>
                </div>
            </figure>
        @endforeach
    </div>
</div>

<div class="modal fade" id="ModalAjoutImage" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="ModalAjoutImage" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Ajouter une image au produit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <br>
            <form action="{{ route('root_espace_admin_create_image_produit') }}"  method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body" style="background-color: #ffff;">

                    <input class="form-control  {{ $errors->has('produit_id') ? 'is-invalid' : '' }}" style="height: 50px;" type="hidden" placeholder="" name="produit_id" id="add_image_id">

                    <div class="form-group">
                        <label for="">Image</label>
                        <input class="form-control {{ $errors->has('image') ? 'is-invalid' : '' }}" style="height: 50px;" type="file" placeholder="" name="image">
                        {!! $errors->first('image', '<p class="text-danger">:message</p>') !!}
                    </div>
                </div>
                <div class="modal-footer"  style="display:block;">
                    <button id="button" type="reset" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn float-right" style="{{ couleur_background_1() }}; {{ couleur_blanche() }};" >Ajouter</button>
                </div>
            </form>
       </div>
    </div>
</div>

@include('layouts.modal', ["route" => route('root_espace_admin_delete_images', 0), 'nom'=>'cette image'])


@endsection
@section('js')
<script>
     $(document).on('click', '#btn_add_image', function(){

        var ID = $(this).attr('data-id');

        $('#add_image_id').val(ID);

        $('#ModalAjoutImage').modal('show');

    });

    $(document).on('click', '#btn_delete_image', function(){

        var ID = $(this).attr('data-id');

        $('#item_id').val(ID);

        $('#DeleteModalCenter').modal('show');
    });

</script>
@endsection
