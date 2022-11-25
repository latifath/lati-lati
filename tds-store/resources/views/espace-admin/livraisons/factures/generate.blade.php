@extends('layouts.master-dashboard')
@section('creation-facture')
@include('layouts.partials-dashboard.entête-page', [
    'infos1' => 'Facture',
    'infos2' => 'Livraisons',
    'infos3' => 'Génération facture',
])
@section('head')
<style>
    .iti{
        display : block !important;
    }
    fieldset{
        border-color: #212529!important;
    }

    .select2-selection--single{
        height: 50px !important;
        border: 1px solid #EDF1FF !important;
    }
</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.2.0/dist/select2-bootstrap-5-theme.min.css" />
@endsection

<br>
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card m-b-30">
            <div class="card-header bg-light">
                <h4 class="mt-2 header-title text-dark" style="font-size: 24px">Générer une facture</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('root_espace_admin_creation_facture') }}" method="POST">
                    @csrf
                    <input class="form-control {{ $errors->has('invoice_id') ? 'is-invalid' : '' }}"  style="height:50px;" type="hidden"  value="{{ $invoice->id }}" placeholder="" name="invoice_id">
                    <div class=" form-group">
                        <label>Désignation</label>
                        <input class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"  style="height:50px;" type="text" placeholder="" name="description">
                        {!! $errors->first('description', '<p class="text-danger">:message</p>') !!}
                    </div>

                    <div class=" form-group">
                        <label>Prix unitaire</label>
                        <div class="d-flex form-group" >
                            <input class="form-control  {{ $errors->has('price') ? 'is-invalid' : '' }}" style="height:50px;" type="price" placeholder="" name="price">
                            {!! $errors->first('price', '<p class="text-danger">:message</p>') !!}
                        </div>
                    </div>

                    <div class=" form-group">
                        <label>Quantité</label>
                        <div class="d-flex form-group">
                            <input class="form-control {{ $errors->has('quantity') ? 'is-invalid' : '' }}" style="height:50px;" type="text" placeholder="" name="quantity">
                            {!! $errors->first('quantity', '<p class="text-danger">:message</p>') !!}
                        </div>
                    </div>

                    <div class="float-right">
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-10 offset-1 mt-4">
        <div class="float-right mb-3">
            <button id ="btn_valide_facture"  data-id="{{ $invoice->id }}" type="button" class="btn btn-primary px-2 py-2"><i class="fa fa-check"></i> Terminer et envoyer le mail</button>
        </div>
        <div class="table-responsive">
            <table id="" class="table table-bordered" style="border-collapse: collapse; border-spacing: 0; width: 100%; {{ couleur_principal() }}">
                <thead>
                    <tr>
                        <th>Désignation</th>
                        <th>Qauntité</th>
                        <th>Prix unitaire</th>
                        <th>Montant</th>
                        <th style="width: 10%;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (invoice_items($invoice->id) as $item)
                        <tr>
                            <td>{{ $item->description }}</td>
                            <td>{{ $item->quantity}}</td>
                            <td>{{ number_format($item->price, '0', '.', '')}} F CFA</td>
                            <td>{{ number_format($item->amount, '0', '.', '')}}  F CFA</td>
                            <td>
                                <button type="button" id="btn_edit_facture" data-id="{{ $item->id }}" data-description="{{ $item->description }}"  data-price="{{ $item->price }}" data-quantity="{{ $item->quantity }}" class="btn btn-primary"> <i class="fa fa-edit" aria-hidden="true"></i> </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@include('espace-admin.livraisons.factures._modal')
@endsection


@section('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>
<script>

    $( 'select' ).select2( {
        theme: "bootstrap-5",
        width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
        placeholder: $( this ).data( 'placeholder' ),
    } );
</script>
<script>

$(document).on('click', '#btn_edit_facture', function(){
    var ID = $(this).attr('data-id');
    var description = $(this).attr('data-description');
    var price = $(this).attr('data-price');
    var quantity = $(this).attr('data-quantity');

    $('#edit_id').val(ID);
    $('#edit_description').val(description);
    $('#edit_prix').val(price);
    $('#edit_quantite').val(quantity);


    $('#ModalModifiefacture').modal('show');
});

$(document).on('click', '#btn_valide_facture', function(){
       var id = $(this).attr('data-id');

       $('#item_id').val(id);

       $('#ModalConfirmationFacture').modal('show');
   });

</script>


@endsection
