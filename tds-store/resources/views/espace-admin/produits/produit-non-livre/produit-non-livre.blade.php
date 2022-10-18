@extends('layouts.master-dashboard')

@section('produit-non-livrer')
@include('layouts.partials-dashboard.entête-page', [
    'infos1' => 'Produit',
    'infos2' => 'Produit',
    'infos3' => 'Produits non livrés',
])
<br>
<div class="row mt-2">
    <div class="col-md-12 col-12">
        <div class="card m-b-30">
           <div class="card-header bg-success">
                <h4 class="mt-3 header-title text-white text-center " style="font-size: 24px;">Produits non livrés</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; {{ couleur_principal() }}">
                        <thead>
                        <tr>
                            <th>N°</th>
                            <th>Id commande</th>
                            <th>Id produit</th>
                            <th>quantite</th>
                            <th>Status</th>
                            <th style="width: 10%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($produits_non_livre as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->commande_id }}</td>
                                    <td>{{ produits_non_livrer($item->produit_id)->nom }}</td>
                                    <td>{{ $item->quantite }}</td>
                                    <td>{{ $item->status }}</td>
                                    <td>
                                        <button  id="btn_confirm_livraison" data-toggle="tooltip" data-id="{{ $item->id }}" title="Confirmer la livraison" class="btn bg-success text-white" ><i class="fa fa-check" aria-hidden="true"></i> Livrée</button>
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

<div class="row mt-2">
    <div class="col-md-12 col-12">
        <div class="card m-b-30">
           <div class="card-header bg-success">
                <h4 class="mt-3 header-title text-white text-center " style="font-size: 24px;">Produits déjà livrés</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable2" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; {{ couleur_principal() }}">
                        <thead>
                        <tr>
                            <th>N°</th>
                            <th>Id commande</th>
                            <th>Id produit</th>
                            <th>Quantité</th>
                            <th>Status</th>
                            <th style="width: 8%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($produits_livre as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->commande_id }}</td>
                                    <td>{{ produits_non_livrer($item->produit_id)->nom }}</td>
                                    <td>{{ $item->quantite}}</td>
                                    <td>{{ $item->status}}</td>
                                    <td>
                                        <button data-toggle="tooltip" title="Annuler la livraison" id="btn_cancel_livraison"  data-id="{{ $item->id }}" class="btn" style="{{ couleur_background_2() }}; {{ couleur_blanche() }}"><i class="fa fa-trash" aria-hidden="true"></i> Non Livrée</button>
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

@include('espace-admin.produits.produit-non-livre._modal')

@endsection

@section('js')
<script>
    $(document).ready(function() {
        $('#datatable2').DataTable();
    });
</script>

<script>
    $(document).on('click', '#btn_confirm_livraison', function(){
       var ID = $(this).attr('data-id');

       $('#item_id').val(ID);

       $('#ModalConfirmLivraison').modal('show');
   });

   $(document).on('click', '#btn_cancel_livraison', function(){
       var id = $(this).attr('data-id');

       $('#id_item').val(id);

       $('#ConfirmationNonLivrerModalCenter').modal('show');
   });
</script>
@endsection

