@extends('layouts.master-dashboard')
@section('categorie')

@include('layouts.partials-dashboard.entête-page', [
    'infos1' => 'Partenaire',
    'infos2' => 'Partenaire',
    'infos3' => 'Tous les partenaires',
])
<br>

<div class="row">
    <div class="col-md-12 col-12">
        <div class="card m-b-30">
           <div class="card-header bg-success">
                <h4 class="mt-3 header-title text-white d-inline-block" style="font-size: 24px;">Tous les partenaires</h4>
                <button id="btn_ajout_partenaire" class="float-right btn d-inline-block text-white border" style="font-size: 24px; {{ couleur_background_1() }}">Ajouter un partenaire</button>
            </div>


            <div class="card-body">
                <div class="table-responsive">
                <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; {{ couleur_principal() }}">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nom</th>
                        <th>Logo</th>
                        <th>Date</th>
                        <th style="width: 15%">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($partenaires as $partenaire)

                        <tr>
                            <td>{{ $partenaire->id }}</td>
                            <td>{{ $partenaire->nom }}</td>
                            {{-- <td>{{ $partenaire->logo }}</td> --}}
                            <td>
                                <figure class="figure px-4 pt-5">
                                    <img src="{{ asset('storage/' . $partenaire->logo) }}" class="figure-img img-fluid rounded" alt="" height="40" width="50">
                                    <div class="row pt-3">
                                        <figcaption class="figure-caption mx-3" style="font-size: 18px;"></figcaption>
                                    </div>
                                </figure>
                            </td>
                            <td>{{ $partenaire->created_at }}</td>
                            <td>
                                <button  id="btn_edit_partenaire" data-id="{{ $partenaire->id }}" data-nom = "{{ $partenaire->nom }}" class="btn btn-primary"><i class="fa fa-edit"></i>Editer</button>
                                <button  id="btn_delete_partenaire" data-id="{{ $partenaire->id }}" class="btn" style="{{ couleur_background_2() }}; {{ couleur_blanche() }}"><i class="fa fa-trash" aria-hidden="true"></i>Supprimer</button>

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
 <div class="modal fade" id="ModalModifiePartenaire" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="ModalModifiePartenaire" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Modifier un partenaire</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('root_espace_admin_edit_partenaire')}}"  method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body" style="background-color: #f0f0f0;">
                    <div class="">
                        <input id="edit_id" class="form-control {{ $errors->has('id') ? 'is-invalid' : '' }}" style="height: 50px;"  type="hidden" placeholder="" name="id" >
                        <div class="form-group">
                            <label for="">Nom</label>
                            <input class="form-control {{ $errors->has('nom') ? 'is-invalid' : '' }}" style="height: 50px;"  type="text" placeholder="entrez le nom" name="nom" id="edit_nom">
                            {!! $errors->first('nom', '<p class="text-danger">:message</p>') !!}
                        </div>

                        <div class="form-group">
                            <label for="">Logo</label>
                            <input class="form-control {{ $errors->has('logo') ? 'is-invalid' : '' }}" style="height: 50px;"  type="file" placeholder="" name="logo" id="edit_logo">
                            {!! $errors->first('logo', '<p class="text-danger">:message</p>') !!}
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


 <div class="modal fade" id="ModalAjoutPartenaire" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="ModalAjoutPartenaire" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Ajouter un partenaire</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('root_espace_admin_partenaire_create')}}"  method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body" style="background-color: #f0f0f0;">
                    <div class="form-group">
                        <label for="">Nom</label>
                        <input class="form-control {{ $errors->has('nom') ? 'is-invalid' : '' }}" style="height: 50px;" type="text" placeholder="Entrez le nom" name="nom">
                        {!! $errors->first('nom', '<p class="text-danger">:message</p>') !!}
                    </div>

                     <div class="form-group">
                        <label for="">Logo</label>
                        <input class="form-control {{ $errors->has('logo') ? 'is-invalid' : '' }}" style="height: 50px;" type="file" placeholder="Entrez le logo" name="logo">
                        {!! $errors->first('logo', '<p class="text-danger">:message</p>') !!}
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

{{-- supprimer --}}
@include('layouts.modal', ["route" => route('root_espace_admin_partenaire_delete', 0), 'nom'=>'cet paretenaire'])

@endsection

@section('js')
<script>
    $(document).on('click', '#btn_edit_partenaire', function(){
        var id = $(this).attr('data-id');
        var nom = $(this).attr('data-nom');


        $('#edit_id').val(id);
        $('#edit_nom').val(nom);


        $('#ModalModifiePartenaire').modal('show');
    });

    $(document).on('click', '#btn_delete_partenaire', function(){
        var ID = $(this).attr('data-id');

        $('#item_id').val(ID);

        $('#DeleteModalCenter').modal('show');
    });

    $(document).on('click', '#btn_ajout_partenaire', function(){

        $('#ModalAjoutPartenaire').modal('show');
    });
</script>
@endsection
