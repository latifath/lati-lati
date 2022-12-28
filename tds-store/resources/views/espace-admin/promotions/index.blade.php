@extends('layouts.master-dashboard')


@section('Admin-index-promotion')

@include('layouts.partials-dashboard.entête-page', [
    'infos1' => 'Promotions',
    'infos2' => 'Promotion',
    'infos3' => 'Toutes les promotions',
])
<br>

<div class="row">
    <div class="col-md-12 col-12">
        <div class="card m-b-30">
           <div class="card-header bg-success">
                <h4 class="mt-3 header-title text-white text-center  d-inline-block" style="font-size: 24px;">Promotions</h4>
                <button  id="btn_ajout_promotion" class="float-right btn d-inline-block text-white border" {{ couleur_background_1() }}><i class="fa fa-plus" aria-hidden="true"> Ajouter une promotion</i></button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table  id="datatable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; {{ couleur_principal() }}">
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
                            @foreach ($promotions as $key => $promotion)
                            <tr>
                                <td>{{ $key + 1 }}</td>
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

@include('espace-admin.promotions._modal')
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
        var id = $(this).attr('data-id');
        var type = $(this).attr('data-type');
        var valeur = $(this).attr('data-valeur');
        var status = $(this).attr('data-status');

        $('#edit_id').val(id);
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


    $(document).on('click', '#generate', function(){
        var code = $(this).attr('data-code');

        function generate_code(length) {
            var result           = '';
            var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            var charactersLength = characters.length;
            for ( var i = 0; i < length; i++ ) {
                result += characters.charAt(Math.floor(Math.random() * charactersLength));
            }
            return result;
        }
        $('#coupon').val(generate_code(8))
    });

    $(document).on('click', '#generate_edit', function(){
        var code = $(this).attr('data-code');

        function generate_code(length) {
            var result           = '';
            var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            var charactersLength = characters.length;
            for ( var i = 0; i < length; i++ ) {
                result += characters.charAt(Math.floor(Math.random() * charactersLength));
            }
            return result;
        }
        $('#coupon_edit').val(generate_code(8))
    });
</script>
@endsection
