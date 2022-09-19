@extends('layouts.master-dashboard')


@section('publicites')

@include('layouts.partials-dashboard.entête-page', [
    'infos1' => 'Dashbord',
    'infos2' => 'Publicités',
    'infos3' => 'publicités',
])
<br>

<div class="row">
    <div class="col-md-12 col-12">
        <div class="card m-b-30">
           <div class="card-header bg-success">
                <h4 class="mt-3 header-title text-white text-center  d-inline-block" style="font-size: 24px;">Publicités</h4>
                <button  id="btn_ajout_publicite" class="float-right btn d-inline-block text-white border" style="font-size: 24px; {{ couleur_background_1() }}">Ajouter une publicité</button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table  class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; {{ couleur_principal() }}">
                        <thead>
                        <tr>
                            <td>N°</td>
                            <th>Nom</th>
                            <th>Message</th>
                            <th>Path</th>
                            <th style="width: 15%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @php
                                $i= 1;
                            @endphp
                            @foreach($publicites as $publicite)
                            <tr>
                                <td>{{ $i}}</td>
                                <td>{{ $publicite->nom }}</td>
                                <td>{{ $publicite->message }}</td>
                                <td>
                                    <figure class="figure px-4 pt-5">
                                        <img src="{{ asset('publicites/' . $publicite->path) }}" class="figure-img img-fluid rounded" alt="" height="40" width="50">
                                        <div class="row pt-3">
                                            <figcaption class="figure-caption mx-3" style="font-size: 18px;"></figcaption>
                                        </div>
                                    </figure>
                                </td>
                                <td>
                                    <button id="btn_edit_publicite" data-id="{{ $publicite->id }}" data-nom="{{ $publicite->nom }}" data-message="{{ $publicite->message }}" class="btn btn-primary"><i class="fa fa-edit"></i>Editer</button>
                                    <button id="btn_delete_publicite" data-id="{{ $publicite->id }}" class="btn" style="{{ couleur_background_2() }}; {{ couleur_blanche() }}"><i class="fa fa-trash"></i>Supprimer</button>
                                </td>

                            </tr>
                            @php
                                $i++;
                            @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ModalAjoutPublicite" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="ModalAjoutPublicite" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Ajout publicité</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <br>
            <form action="{{ route('root_espace_admin_ajouter_publicites') }}"  method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body" style="background-color: #f0f0f0;">

                <input class="form-control {{ $errors->has('id') ? 'is-invalid' : '' }}" style="height: 50px;" type="hidden" placeholder="" name="id" id="add_id">

                <div class="form-group">
                    <label for="">Nom</label>
                    <input class="form-control {{ $errors->has('nom') ? 'is-invalid' : '' }}" style="height: 50px;" type="text" placeholder="" name="nom">
                    {!! $errors->first('nom', '<p class="text-danger">:message</p>') !!}
                </div>

                 <div class="form-group">
                    <label for="">Message</label>
                    <input class="form-control {{ $errors->has('message') ? 'is-invalid' : '' }}" style="height: 50px;" type="text" placeholder="" name="message">
                    {!! $errors->first('message', '<p class="text-danger">:message</p>') !!}
                </div>

                <div class="form-group">
                    <label for="">Path</label>
                    <input class="form-control {{ $errors->has('path') ? 'is-invalid' : '' }}" style="height: 50px;" type="file" placeholder="" name="path">
                    {!! $errors->first('path', '<p class="text-danger">:message</p>') !!}
                </div>

                <div class="modal-footer float-right">
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </div>
                </div>
            </form>
       </div>
    </div>
</div>

<div class="modal fade" id="ModalModifiepublicite" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="ModalModifiepublicite" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Modification publicité </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('root_espace_admin_modifier_publicites') }}"  method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body" style="background-color: #f0f0f0;">

                <input class="form-control {{ $errors->has('id') ? 'is-invalid' : '' }}" style="height: 50px;" type="hidden" placeholder="" name="id" id="edit_id">

                <div class="form-group">
                    <label for="">Nom</label>
                    <input class="form-control {{ $errors->has('nom') ? 'is-invalid' : '' }}" style="height: 50px;" type="text" placeholder="" name="nom" id="edit_nom">
                    {!! $errors->first('nom', '<p class="text-danger">:message</p>') !!}
                </div>

                 <div class="form-group">
                    <label for="">Message</label>
                    <input class="form-control {{ $errors->has('message') ? 'is-invalid' : '' }}" style="height: 50px;" type="text" placeholder="" name="message" id="edit_message">
                    {!! $errors->first('message', '<p class="text-danger">:message</p>') !!}
                </div>

                <div class="form-group">
                    <label for="">Path</label>
                    <input class="form-control {{ $errors->has('path') ? 'is-invalid' : '' }}" style="height: 50px;" type="file" placeholder="" name="path" id="edit_path">
                    {!! $errors->first('path', '<p class="text-danger">:message</p>') !!}
                </div>

                <div class="modal-footer float-right">
                    <button type="submit" class="btn btn-primary">Modifier</button>
                </div>
                </div>
            </form>
       </div>
    </div>
</div>

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

        $('#edit_id').val(id);
        $('#edit_nom').val(nom);
        $('#edit_message').val(message);

        $('#ModalModifiepublicite').modal('show');
    });

    $(document).on('click', '#btn_delete_publicite', function(){

        var ID = $(this).attr('data-id');

        $('#item_id').val(ID);

        $('#DeleteModalCenter').modal('show');
    });


</script>
@endsection
