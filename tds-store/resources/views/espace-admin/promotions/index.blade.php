@extends('layouts.master-dashboard')


@section('Admin-index-promotion')

@include('layouts.partials-dashboard.entête-page', [
    'infos1' => 'Promotion',
    'infos2' => 'Promotion',
    'infos3' => 'Toutes les promotions',
])
<br>
<div class="row">
    <div class="col-md-12 col-12">
        <div class="card m-b-30">
           <div class="card-header bg-success">
                <h4 class="mt-3 header-title text-white text-center  d-inline-block" style="font-size: 24px;">Promotions</h4>
                <button  id="btn_ajout_promotion" class="float-right btn d-inline-block text-white border" style="font-size: 24px; {{ couleur_background_1() }}">Ajouter une promotion</button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table  class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; {{ couleur_principal() }}">
                        <thead>
                        <tr>
                            <td>Id</td>
                            <th>Code coupon</th>
                            <th>Type coupon</th>
                            <th>Valeur coupon </th>
                            <th>Status</th>
                            <th style="width: 10%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($promotions as $promotion)
                            <tr>
                                <td>{{ $promotion->id }}</td>
                                <td>{{ $promotion->code }}</td>
                                <td>{{ $promotion->type }}</td>
                                <td>{{ $promotion->valeur }}</td>
                                <td>{{ $promotion->status }}</td>
                                <td>
                                    <button  id="btn_edit_promotion" data-id="{{ $promotion->id }}" data-code="{{ $promotion->code }}" data-type="{{ $promotion->type }}" data-valeur="{{ $promotion->valeur }}" data-status="{{ $promotion->status }}" data-toggle="tooltip" title="Editer" class="btn btn-primary"><i class="fa fa-edit"></i></button>
                                    <button id="btn_delete_promotion"  data-id="{{ $promotion->id }}" data-toggle="tooltip"  title="Supprimer" id="btn_delete_image" class="btn" style="{{ couleur_background_2() }}; {{ couleur_blanche() }}"><i class="fa fa-trash" aria-hidden="true"></i></button>
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

<div class="modal fade" id="ModalAjoutPromotion" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="ModalAjoutPromotion" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Ajout d'une promotion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <br>
            <form action="{{ route('root_espace_admin_promotion_ajouter') }}"  method="POST">
                @csrf
                <div class="modal-body" style="background-color: #f0f0f0;">

                <input class="form-control {{ $errors->has('id') ? 'is-invalid' : '' }}" style="height: 50px;" type="hidden" placeholder="" name="id" id="add_id">

                <div class="form-group">
                    <label for="">Code coupon</label>
                    <input class="form-control {{ $errors->has('code_coupon') ? 'is-invalid' : '' }}" style="height: 50px;" type="text" placeholder="" name="code_coupon">
                    {!! $errors->first('code_coupon', '<p class="text-danger">:message</p>') !!}
                </div>

                <div class="form-group">
                    <label for="">Type coupon</label>
                    <select class="custom-select {{ $errors->has('type') ? 'is-invalid' : '' }}" style="height: 50px;" name="type" >
                        <option value="fixed">fixed</option>

                        <option value="percent_of">percent_of</option>

                    </select>
                    {!! $errors->first('type', '<p class="text-danger">:message</p>') !!}
                </div>

                 <div class="form-group">
                    <label for="">Valeur coupon</label>
                    <input class="form-control {{ $errors->has('valeur') ? 'is-invalid' : '' }}" style="height: 50px;" type="text" placeholder="" name="valeur">
                    {!! $errors->first('valeur', '<p class="text-danger">:message</p>') !!}
                </div>

                <div class="form-group">
                    <label for="">Status</label>
                    <select class="custom-select {{ $errors->has('status') ? 'is-invalid' : '' }}" style="height: 50px;" name="status" >
                        <option value="en cous">En cours </option>
                        <option value="termine">Termine</option>
                    </select>
                    {!! $errors->first('status', '<p class="text-danger">:message</p>') !!}
                </div>

                <div class="modal-footer float-right">
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </div>
                </div>
            </form>
       </div>
    </div>
</div>

<div class="modal fade" id="ModalModifiePromotion" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="ModalModifiePromotion" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Modification coupon</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('root_espace_admin_promotion_update')}}"  method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body" style="background-color: #f0f0f0;">

                    <input id="edit_id" class="form-control {{ $errors->has('id') ? 'is-invalid' : '' }}" type="hidden" placeholder="" name="id" id="edit_id">
                    <div class="form-group">
                        <label for="">Code coupon</label>
                        <input class="form-control {{ $errors->has('code_coupon') ? 'is-invalid' : '' }}" style="height: 50px;" type="text" placeholder="" name="code_coupon" id='edit_code'>
                        {!! $errors->first('code_coupon', '<p class="text-danger">:message</p>') !!}
                    </div>

                    <div class="form-group">
                        <label for="">Type coupon</label>
                        <select class="custom-select {{ $errors->has('type') ? 'is-invalid' : '' }}" style="height: 50px;" name="type" id='edit_type'>
                            <option value="fixed">fixed</option>

                            <option value="percent_of">percent_of</option>

                        </select>
                        {!! $errors->first('type', '<p class="text-danger">:message</p>') !!}
                    </div>

                     <div class="form-group">
                        <label for="">Valeur coupon</label>
                        <input class="form-control {{ $errors->has('valeur') ? 'is-invalid' : '' }}" style="height: 50px;" type="text" placeholder="" name="valeur" id='edit_valeur'>
                        {!! $errors->first('valeur', '<p class="text-danger">:message</p>') !!}
                    </div>

                    <div class="form-group">
                        <label for="">Status</label>
                        <select class="custom-select {{ $errors->has('status') ? 'is-invalid' : '' }}" style="height: 50px;" name="status" id='edit_status'>
                            <option value="en cours">En cours </option>
                            <option value="termine">Termine</option>
                        </select>
                        {!! $errors->first('status', '<p class="text-danger">:message</p>') !!}
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

@include('layouts.modal', ["route" => route('root_espace_admin_promotion_delete', 0), 'nom'=>'cette promotion'])

@endsection
@section('js')
<script>

$(document).on('click', '#btn_ajout_promotion', function(){

    var ID = $(this).attr('data-id');


    $('#add_id').val(ID);

$('#ModalAjoutPromotion').modal('show');
});

$(document).on('click', '#btn_edit_promotion', function(){
        var ID = $(this).attr('data-id');
        var code = $(this).attr('data-code');
        var type = $(this).attr('data-type');
        var valeur = $(this).attr('data-valeur');
        var status = $(this).attr('data-status');

        $('#edit_id').val(ID);
        $('#edit_code').val(code);
        $('#edit_type').val(type);
        $('#edit_valeur').val(valeur);
        $('#edit_status').val(status);


        $('#ModalModifiePromotion').modal('show');
    });

    $(document).on('click', '#btn_delete_promotion', function(){

        var ID = $(this).attr('data-id');

        $('#item_id').val(ID);

        $('#DeleteModalCenter').modal('show');
    });

</script>
@endsection
