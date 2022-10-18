@extends('layouts.master-dashboard')

@section('correction-stock')

@include('layouts.partials-dashboard.entête-page', [
    'infos1' => 'Stocks',
    'infos2' => 'correction stock',
    'infos3' => 'Correction stock',
])
<br>

<div class="row">
    <div>
        <button class="btn border mb-3 mx-3" onClick="imprimer('magazin')" style="{{ couleur_background_1() }}; {{ couleur_blanche() }}; text-white;">
            <i class="fa fa-print" aria-hidden="true" input type="button" value="Imprimer"> </i> Imprimer
        </button>
    </div>

    <div class="col-md-12 col-12">
        <div class="card m-b-30">
           <div class="card-header bg-success">
                <h4 class="mt-3 header-title text-white "  style="font-size: 24px; text-align: center;">STOCKS</h4>
            </div>
           <div class="card-body">
            <div class="table-responsive">
                <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; {{ couleur_principal() }}">
                    <thead>
                    <tr>
                        <th>N°</th>
                        <th>Nom</th>
                        <th>Quantite</th>
                        <th>Prix</th>
                        <th>Sous-Catégorie</th>
                        <th style="width: 10%">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp

                        @foreach($produits as $produit)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $produit->nom }}</td>
                            <td>{{ $produit->quantite }}</td>
                            <td>{{number_format($produit->prix, '0', '.', ' ')}}FCFA</td>
                            <td>{{ $produit->sous_categorie->nom}}</td>
                            <td>
                                <button  id="btn_edit_correction_stock" data-id="{{ $produit->id }}" data-quantite="{{ $produit->quantite }}" class="btn" style="background-color: #007bff; border: #007bff; color: white;"><i class="fa fa-refresh"></i></button>
                                {{-- <button  id="btn_edit_stock"  class="btn btn-primary"><i class="fa fa-edit"></i> Editer</button>
                                <button  id="btn_delete_stock" class="btn" style="{{ couleur_background_2() }}; {{ couleur_blanche() }}"><i class="fa fa-trash" aria-hidden="true"></i> Supprimer</button> --}}
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
<div class="modal fade" id="ModalCorrectionStock" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="ModalCorrectionStock" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Régularisation du stock</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('root_espace_admin_edit_correction')}}"  method="POST">
                @csrf
                @method('put')
                <div class="modal-body" style="background-color: #ffff;">
                    <div class="">
                        <input id="edit_id" class="form-control {{ $errors->has('id') ? 'is-invalid' : '' }}" type="hidden" placeholder="" name="id" >
                        <div class="form-group">
                            <label for="">Quantité</label>
                            <input class="form-control {{ $errors->has('quantite') ? 'is-invalid' : '' }}" style="height: 50px;" type="text" placeholder="entrez la sous-catégorie" name="quantite" id="edit_quantite">
                            {!! $errors->first('quantite', '<p class="text-danger">:message</p>') !!}
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="display:block;">
                    <button id="button" type="reset" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                   <button type="submit" class="btn float-right" style="{{ couleur_background_1() }}; {{ couleur_blanche() }};" >Corriger</button>

                </div>
            </form>
       </div>
    </div>
</div>

 {{-- contenu impression --}}
<div class="d-none">
    <div id='magazin'>
        <h3  class="text-center">INFORMATIONS SUR LE STOCK</h3>
        <table class="table table-striped table-bordered dt-responsive nowrap " style="border-collapse: collapse; border-spacing: 0; width: 100%; {{ couleur_principal() }}">
            <thead>
            <tr>
                <th>N°</th>
                <th>Nom</th>
                <th>Quantite</th>
                <th>Prix</th>
                <th>Sous-catégorie</th>
                <th>Catégorie</th>

            </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                @endphp

                @foreach($produits as $produit)
                <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $produit->nom }}</td>
                    <td>{{ $produit->quantite }}</td>
                    <td>{{ number_format($produit->prix, '0', '.', ' ')}}FCFA</td>
                    <td>{{ $produit->sous_categorie->nom}}</td>
                    <td>{{ $produit->sous_categorie->categorie->nom}}</td>

                </tr>
                @php
                $i++;
            @endphp
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
@section('js')
<script>
$(document).on('click', '#btn_edit_correction_stock', function(){
    var ID = $(this).attr('data-id');
    var quantite = $(this).attr('data-quantite');

    $('#edit_id').val(ID);
    $('#edit_quantite').val(quantite);
    $('#ModalCorrectionStock').modal('show');
});
</script>

<script>
    function imprimer(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
        window.location.reload();
    }
</script>

@endsection
