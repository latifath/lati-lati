<?php
use Illuminate\Support\Carbon;
?>
@extends('layouts.master-dashboard')
@section('head')
<style>
    /* .modal-body{
        border: 1px solid;
    } */
    .form-control{
        border: 1px solid;
    }
</style>
@endsection

@section('stocks')

@include('layouts.partials-dashboard.entête-page', [
    'infos1' => 'Stocks',
    'infos2' => 'Stocks',
    'infos3' => 'Tous les stocks',
])
<br>

<div class="row">
    <div class="col-md-12 col-12">
        <div class="card m-b-30">
           <div class="card-header bg-success">
                <h4 class="mt-3 header-title text-white "  style="font-size: 24px; text-align: center;">Tous les stocks </h4>
            </div>
           <div class="card-body">
            <div class="table-responsive">
                <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; {{ couleur_principal() }}">
                    <thead>
                    <tr>
                        <th>N°</th>
                        <th>Nom produit</th>
                        <th>Prix unitaire</th>
                        <th>Quantité</th>
                        <th>Montant</th>
                        <th>Date</th>
                        <th style="width: 15%">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($stocks as $stock)

                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $stock->nom_produit }}</td>
                            <td>{{ number_format($stock->prix_unitaire, '0', '.', ' ')}} F CFA</td>
                            <td>{{ $stock->quantite}}</td>
                            <td>{{number_format($stock->montant, '0', '.', ' ')}}</td>
                            <td>{{ $stock->created_at}}</td>
                            <td>
                                {{-- {{ dd(\Carbon\Carbon::parse($stock->created_at) > \Carbon\Carbon::now()) }} --}}
                                @if(\Carbon\Carbon::parse($stock->created_at . '+3 days') >= \Carbon\Carbon::now())
                                    <button  data-toggle="tooltip" title="Editer" id="btn_edit_stock" data-id="{{ $stock->id }}" data-quantite="{{$stock->quantite }}" data-prix_unitaire="{{ $stock->prix_unitaire }}" class="btn btn-primary"><i class="fa fa-edit"></i></button>
                                    <button data-toggle="tooltip" title="Supprimer" id="btn_delete_stock"  data-id="{{ $stock->id }}" class="btn" style="{{ couleur_background_2() }}; {{ couleur_blanche() }}"><i class="fa fa-trash" aria-hidden="true"></i></button>

                                @else


                                @endif
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

<div class="modal fade" id="ModalModifieStock" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="ModalModifieStock" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Modifier le stock</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true" style="color:white;">&times;</span>
                </button>
            </div>
            <form action="{{ route('root_espace_admin_edit_stock')}}"  method="POST">
                @csrf
                @method('put')
                <div class="modal-body" style="background-color: #f0f0f0;">

                    <input id="edit_id" class="form-control {{ $errors->has('id') ? 'is-invalid' : '' }}" type="hidden" placeholder="" name="id" >
                    <div class="form-group">
                        <label for="">Quantité</label>
                        <input class="form-control {{ $errors->has('quantite') ? 'is-invalid' : '' }}" style="height: 50px;" type="text" placeholder="entrez la sous-catégorie" name="quantite" id="edit_quantite">
                        {!! $errors->first('quantite', '<p class="text-danger">:message</p>') !!}
                    </div>
                    <div class="form-group">
                        <label for="">Prix_unitaire</label>
                        <input class="form-control {{ $errors->has('prix_unitaire') ? 'is-invalid' : '' }}" style="height: 50px;" type="text" placeholder="entrez la sous-catégorie" name="prix_unitaire" id="edit_prix_unitaire">
                        {!! $errors->first('prix_unitaire', '<p class="text-danger">:message</p>') !!}
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

@include('layouts.modal', ["route" => route('root_espace_admin_delete_stock', 0), 'nom'=>'ce stock'])

@endsection

@section('js')
<script>

$(document).on('click', '#btn_edit_stock', function(){
        var ID = $(this).attr('data-id');
        var quantite = $(this).attr('data-quantite');
        var prix_unitaire = $(this).attr('data-prix_unitaire');
        // var montant = $(this).attr('data-montant');
        // var nom_produit = $(this).attr('data-nom_produit');
        // var produit_id = $(this).attr('data-produit_id');

        $('#edit_id').val(ID);
        $('#edit_quantite').val(quantite);
        $('#edit_prix_unitaire').val(prix_unitaire);
        // $('#edit_montant').val(montant);
        // $('#edit_nom_produit').val(nom_produit);
        // $('#edit_produit_id').val(produit_id);

        $('#ModalModifieStock').modal('show');
    });

    $(document).on('click', '#btn_delete_stock', function(){
        var ID = $(this).attr('data-id');

        $('#item_id').val(ID);

        $('#DeleteModalCenter').modal('show');
    });
</script>
@endsection
